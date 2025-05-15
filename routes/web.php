<?php

use App\Livewire\{Home, ReceivablesRegistration};
use App\Livewire\Master\{SubDistricts, Roles, Users, Categories, Consumers, Products};
use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| php artisan make:datatable UsersTable User
| php artisan make:livewire SuspendAccounts
|
*/

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function() {
    //DASHBOARD
    Route::get('/', Home::class)->name('dashboard');

    // Search Ajax
    Route::get('search/{category}', [HomeController::class, 'search'])->name('search');

    //MASTER
    // Route::name('master.')->prefix('master')->group(function () {

        Route::get('users', Users::class)->name('users');
        Route::get('roles', Roles::class)->name('roles');
        Route::get('categories', Categories::class)->name('categories');
        Route::get('products', Products::class)->name('products');
        Route::get('sub-districts', SubDistricts::class)->name(name: 'sub-districts');
        Route::get('consumers', Consumers::class)->name('consumers');

        // Route::get('courses', CoursesIndex::class)->name('courses');
        // Route::name('courses.')->prefix('courses')->group(function () {
        //     Route::get('create', Courses::class)->name('create');
        //     Route::get('{id}/edit', Courses::class)->name('edit');
        // });
    // });

    //Receivables Registration
    // Route::get('receivables-registration', ReceivablesRegistration::class)->name('receivables-registration');

    Route::name('receivables-registration.')->prefix('receivables-registration')->group(function () {
        Route::get('/', ReceivablesRegistration::class)->name('index');
        Route::get('{id}/print-invoice', [HomeController::class, 'printInvoice'])->name('print-invoice');
        Route::get('{id}/print-angsuran-coupon', [HomeController::class, 'printAngsuranCoupon'])->name('print-angsuran-coupon');
        Route::get('{id}/print-angsuran-card', [HomeController::class, 'printAngsuranCard'])->name('print-angsuran-card');
    });
});
