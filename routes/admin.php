<?php

use App\Http\Controllers\Admin\{
    AdminController,
    DashboardController,
    InvoiceController,
    OrderController,
    PermissionController,
    ProductController,
    ProfileController,
    ProofController,
    ArtworkController,
    QuoteController,
    QuoteItemController,
    RoleController,
    SettingController,
    UserController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page Route
Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::get('/test', function() {
    return view('emails.orders.quote');
});

Route::group(['prefix' => 'role-management'], function () {
    Route::resource('role', RoleController::class);
    Route::get('permission', PermissionController::class)->name('permission.index');
    Route::resource('staff', AdminController::class);
});

Route::resource('user', UserController::class)->except('show');
Route::get('user/quotes/{id}', [UserController::class, 'showUserQuotes'])->name('user.quotes');
Route::get('user/files/{id}', [UserController::class, 'showUserFiles'])->name('user.files');
Route::resource('product', ProductController::class)->except('show');

Route::get('quotes/drafts', [QuoteController::class, 'showDrafts'])->name('quotes.drafts');
Route::get('quotes/approve-quote/{quote}', [QuoteController::class, 'approveQuote'])->name('quotes.approve');
Route::put('quotes/confirm-approval/{quote}', [QuoteController::class, 'confirmApproval'])->name('quotes.confirm-approve');
Route::resource('quotes', QuoteController::class);
Route::get('quote/download-quote/{id}', [QuoteController::class, 'downloadQuote'])->name('quotes.download');
// Route::post('save-quote-as-draft', [QuoteController::class, 'draftQuote'])->name('draft-quote');
Route::resource('quote-item', QuoteItemController::class)->only('index','destroy');
Route::resource('order', OrderController::class);
Route::resource('proof', ProofController::class);
Route::resource('artwork', ArtworkController::class);

Route::resource('invoice', InvoiceController::class);
Route::put('invoice/update-invoice-status/{invoice}', [InvoiceController::class, 'updateInvoiceStatus'])->name('invoice.update-status');
Route::put('invoice/update-vat-status/{invoice}', [InvoiceController::class, 'updateVatStatus'])->name('invoice.update-vat-status');
Route::get('invoice/change-invoice-status/{invoice}', [InvoiceController::class, 'showChangeInvoiceStatusForm'])->name('invoice.change-status');
Route::get('invoice/change-vat-status/{invoice}', [InvoiceController::class, 'showChangeVatStatusForm'])->name('invoice.change-vat');
Route::get('invoice/download-invoice/{id}', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');
Route::get('invoice/filter-status/{status}', [InvoiceController::class, 'filterStatus'])->name('filter-invoice-status');

Route::singleton('profile', ProfileController::class);
Route::singleton('setting', SettingController::class);
