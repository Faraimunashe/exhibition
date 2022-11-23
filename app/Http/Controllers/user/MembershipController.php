<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Paynowlog;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function index()
    {
        $member = Member::where('user_id', Auth::id())->first();
        return view('user.membership', [
            'member' => $member
        ]);
    }

    public function apply(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'sex' => ['required', 'string'],
            'phone' => ['required', 'digits:10', 'starts_with:07'],
            'address' => ['required', 'string'],
        ]);

        try{
            $member = new Member();
            $member->user_id = Auth::id();
            $member->fname = $request->fname;
            $member->lname = $request->lname;
            $member->sex = $request->sex;
            $member->phone = $request->phone;
            $member->address = $request->address;

            $member->save();

            return redirect()->back()->with('success', 'successfully added member details');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function apply_fee(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
            'phone' => ['required', 'digits:10', 'starts_with:07']
        ]);

        $wallet = "ecocash";

        //get all data ready
        $email = "jimmymotofire@gmail.com";
        $phone = $request->phone;
        $amount = $request->amount;

        $member = Member::where('user_id', Auth::id())->first();
        if(is_null($member)){
            return redirect()->back()->back('error', 'Could not find membership details');
        }

        /*determine type of wallet*/
        if (strpos($phone, '071') === 0) {
            $wallet = "onemoney";
        }

        $paynow = new \Paynow\Payments\Paynow(
            "11336",
            "1f4b3900-70ee-4e4c-9df9-4a44490833b6",
            route('user-apply-fee'),
            route('user-apply-fee'),
        );

        // Create Payments
        $invoice_name = "Membership-Application" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("Gweru-Exhibition Membership", $amount);

        $response = $paynow->sendMobile($payment, $phone, $wallet);
        //dd($response);
        // Check transaction success
        if ($response->success()) {

            $timeout = 9;
            $count = 0;

            while (true) {
                sleep(3);
                // Get the status of the transaction
                // Get transaction poll URL
                $pollUrl = $response->pollUrl();
                $status = $paynow->pollTransaction($pollUrl);


                //Check if paid
                if ($status->paid()) {
                    // Yay! Transaction was paid for
                    // You can update transaction status here
                    // Then route to a payment successful
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::id();
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "membership-application";
                    $trans->method = "paynow";
                    $trans->amount = $info['amount'];
                    $trans->status = 1;
                    $trans->save();

                    $member->paid = true;
                    $member->save();

                    return redirect()->back()->with('success', 'Succesfully paid license fee');
                }


                $count++;
                if ($count > $timeout) {
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    $trans_status = 2;
                    if($info['status'] != 'sent')
                    {
                        $trans_status = 0;
                    }
                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::id();
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "membership-application";
                    $trans->method = "paynow";
                    $trans->amount = $info['amount'];
                    $trans->status = $trans_status;
                    $trans->save();

                    return redirect()->back()->with('error', 'Taking too long wait a moment and refresh');
                } //endif
            } //endwhile
        } //endif

        //total fail
        return redirect()->back()->with('error', 'Cannot perform transaction at the moment');
    }
}
