<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\PaymentController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth', 'verified')->prefix('doctor')->name('doctor.')->group(function () {

    Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');

    Route::resource('/doctor', DoctorController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* Route::get('/payment', [PaymentController::class, 'showPaymentForm']);
    Route::post('/payment/process', [PaymentController::class, 'processPayment']); */

    // Mostra il modulo di pagamento
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');

    // Elabora il pagamento
    /* Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process'); */
    Route::post('/doctor/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    // Pagamento riuscito
    Route::get('/payment/success', function () {
        return "Pagamento riuscito!";
    })->name('payment.success');

    // Pagamento fallito
    Route::get('/payment/failure', function () {
        $error = session('error');
        return "Pagamento fallito. Errore: " . $error;
    })->name('payment.failure');
})


;

require __DIR__ . '/auth.php';
