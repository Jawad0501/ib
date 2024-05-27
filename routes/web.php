<?php


use App\Http\Controllers\Frontend\{
    ApprovalProofController,
    CheckoutController,
    DashboardController,
    FileController,
    InvoiceController,
    OrderController,
    PaymentController,
    PlaceOrderController,
    ProfileController,
    QuoteController,
};

use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function() {
    $quote = \App\Models\Quote::find(7);
    return view('emails.orders.invoice', compact('quote'));
});
Route::redirect('/', '/login')->name('home');

Route::get('/place-order/{invoice}/{active}', [PlaceOrderController::class,'index'])->name('placeorder.index');
Route::post('/place-order/{invoice}', [PlaceOrderController::class,'store'])->name('placeorder.store');

Route::get('/approval-proof/{invoice}', [ApprovalProofController::class,'index'])->name('approval.index');
Route::post('/approval-proof/{invoice}', [ApprovalProofController::class,'store'])->name('approval.store');

Route::get('/checkout/{invoice}', [CheckoutController::class,'index'])->name('checkout.index');
Route::post('/checkout/{invoice}', [CheckoutController::class,'store'])->name('checkout.store');

Route::get('payment/{status}', [PaymentController::class, 'callback'])->name('payment.callback');

Route::post('quote/store', [QuoteController::class, 'store'])->name('quote.store');
Route::post('invoice/ask-invoice-mail', [InvoiceController::class, 'askForInvoiceMail'])->name('invoice.message');
Route::get('invoice/send-invoice/{invoice}', [InvoiceController::class, 'sendInvoice'])->name('invoice.send-invoice');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('quote', QuoteController::class)->except('store');
    Route::get('quote/order-quote/{id}/{page}/{type}', [QuoteController::class, 'showOrder'])->name('order-quote');
    Route::get('quote/download-quote/{id}/{type}', [QuoteController::class, 'downloadQuote'])->name('download-quote');
    Route::post('quote/reorder', [QuoteController::class, 'reorderQuote'])->name('reorder-quote');
    Route::resource('order', OrderController::class)->only('index','show');

    Route::get('file/add-folder', [FileController::class, 'addFolder'])->name('file.add-folder');
    Route::post('file/store-folder', [FileController::class, 'storeFolder'])->name('file.store-folder');
    Route::delete('file/delete-folder/{id}', [FileController::class, 'deleteFolder'])->name('file.delete-folder');
    Route::put('file/update-folder/{id}', [FileController::class, 'updateFolder'])->name('file.update-folder');
    Route::get('file/show-folder/{id}', [FileController::class, 'showFolder'])->name('file.show-folder');
    Route::resource('file', FileController::class)->only('index','show');
    Route::get('check-file-in-folder/{type}', [FileController::class, 'checkFileInFolder'])->name('file.check-file-belongs-to-folder');
    Route::delete('file/remove-file-from-folder/{folder}/{file}/{type}', [FileController::class, 'removeFileFromFolder'])->name('file.remove-file-from-folder');
    Route::post('file/move-to-folder', [FileController::class, 'moveToFolder'])->name('file.move-to-folder');
    Route::put('file/move-to-another-folder/{move_to}/{move_from}/{file}/{type}', [FileController::class, 'moveToAnotherFolder'])->name('file.move-to-another-folder');
    Route::get('upload-file/{folder}', [FileController::class, 'uploadFile'])->name('file.upload-file');
    Route::post('store-file', [FileController::class, 'storeFile'])->name('file.store-file');
    Route::post('store-file-to-folder/{folder}', [FileController::class, 'storeFileToFolder'])->name('file.store-file-to-folder');
    Route::put('update-recently-viewed-file', [FileController::class, 'updateRecentView'])->name('file.update-recently-viewed-file');
    Route::get('file/request-for-quote/{file}/{file_type}', [FileController::class, 'requestQuote'])->name('file.request-for-quote');
    Route::get('file/request-quote/add-item', [FileController::class, 'addItem'])->name('file.add-item');
    Route::post('submit-request', [FileController::class, 'submitQuoteRequest'])->name('file.submit-request');


    Route::resource('invoice', InvoiceController::class)->only('index','show','edit');
    Route::get('invoice/download-invoice/{id}', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');
    Route::singleton('profile', ProfileController::class);

    // Route::get('admin/invoice/change-invoice-status/{invoice}', [AdminInvoiceController::class, 'showChangeInvoiceStatusForm'])->name('invoice.change-invoice-status');

    Route::get('/rough', [QuoteController::class, 'rough'])->name('rough');

});

require __DIR__.'/auth.php';
