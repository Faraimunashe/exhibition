<?php

namespace App\Http\Controllers\exhibitor;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id());
        return view('exhibitor.transactions', [
            'transactions' => $transactions
        ]);
    }
}
