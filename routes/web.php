<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->middleware(['auth'])->name('profile');
Route::get('/profile/change-password', 'App\Http\Controllers\ProfileController@change')->middleware(['auth'])->name('change-password');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');
Route::get('/report', 'App\Http\Controllers\admin\ReportController@index')->middleware(['auth'])->name('report');


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', 'App\Http\Controllers\admin\DashboardController@index')->name('admin-dashboard');

    Route::get('/admin/exhibitors', 'App\Http\Controllers\admin\ExhibitorController@index')->name('admin-exhibitors');
    Route::post('/admin/update-exhibitor', 'App\Http\Controllers\admin\ExhibitorController@add')->name('admin-update-exhibitor');

    Route::get('/admin/members', 'App\Http\Controllers\admin\MemberController@index')->name('admin-members');
    Route::post('/admin/update-member', 'App\Http\Controllers\admin\MemberController@update')->name('admin-update-member');

    Route::get('/admin/users', 'App\Http\Controllers\admin\UserController@index')->name('admin-users');

    Route::get('/admin/transactions', 'App\Http\Controllers\admin\TransactionController@index')->name('admin-transactions');

    Route::get('/admin/notices', 'App\Http\Controllers\admin\NoticeController@index')->name('admin-notices');
    Route::post('/admin/add-notice', 'App\Http\Controllers\admin\NoticeController@add')->name('admin-add-notice');
    Route::post('/admin/delete-notice', 'App\Http\Controllers\admin\NoticeController@delete')->name('admin-delete-notice');

    Route::get('/admin/votes', 'App\Http\Controllers\admin\VoteController@index')->name('admin-votes');
    Route::post('/admin/add-voter', 'App\Http\Controllers\admin\DashboardController@add_voter')->name('admin-add-voter');
});


Route::group(['middleware' => ['auth', 'role:exhibitor']], function () {
    //votes  //products //fetured categories //
    Route::get('/exhibitor/dashboard', 'App\Http\Controllers\exhibitor\DashboardController@index')->name('exhibitor-dashboard');

    Route::get('/exhibitor/transactions', 'App\Http\Controllers\exhibitor\TransactionController@index')->name('exhibitor-transactions');

    Route::get('/exhibitor/products', 'App\Http\Controllers\exhibitor\ProductController@index')->name('exhibitor-products');
    Route::post('/exhibitor/add-product', 'App\Http\Controllers\exhibitor\ProductController@add')->name('exhibitor-add-product');
    Route::post('/exhibitor/add-product-pic', 'App\Http\Controllers\exhibitor\ProductController@add_pic')->name('exhibitor-add-product-pic');
    Route::post('/exhibitor/update-product', 'App\Http\Controllers\exhibitor\ProductController@update')->name('exhibitor-update-product');
    Route::post('/exhibitor/delete-product', 'App\Http\Controllers\exhibitor\ProductController@delete')->name('exhibitor-delete-product');


});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/home', 'App\Http\Controllers\user\DashboardController@index')->name('user-dashboard');
    Route::get('/products/{id}', 'App\Http\Controllers\user\DashboardController@products')->name('user-products');

    Route::get('/exhibit', 'App\Http\Controllers\user\ExhibitController@index')->name('user-exhibit');
    Route::get('/adjudication', 'App\Http\Controllers\user\ExhibitController@adjudication')->name('user-adjudication');
    Route::post('/apply-exhibition', 'App\Http\Controllers\user\ExhibitController@apply')->name('user-apply-exhibit');

    Route::get('/vote/{exhibition_id}', 'App\Http\Controllers\user\VoteController@vote')->name('user-vote');
    Route::get('/votes', 'App\Http\Controllers\user\VoteController@index')->name('user-votes');

    Route::get('/notices', 'App\Http\Controllers\user\NoticeController@index')->name('user-notices');


    Route::get('/membership', 'App\Http\Controllers\user\MembershipController@index')->name('user-membership');
    Route::post('/apply-membership', 'App\Http\Controllers\user\MembershipController@apply')->name('user-apply-membership');
    Route::post('/apply-fee', 'App\Http\Controllers\user\MembershipController@apply_fee')->name('user-apply-fee');
    Route::post('/subscribe-membership', 'App\Http\Controllers\user\MembershipController@subscribe')->name('user-subscribe-membership');

});
require __DIR__.'/auth.php';
