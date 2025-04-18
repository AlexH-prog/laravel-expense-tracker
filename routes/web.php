<?php
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
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

Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//***************************************************************************************************

// Публичный доступ (для всех пользователей)
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');

// Только для авторизованных пользователей
Route::middleware('auth')->group(function () {
    // CRUD для общих данных расходов
    Route::get('/expenses/create-general', [ExpenseController::class, 'createGeneral'])->name('general-expenses.create');
    Route::post('/expenses/store-general', [ExpenseController::class, 'storeGeneral'])->name('general-expenses.store');
    Route::get('/expenses/{expense}/edit-general', [ExpenseController::class, 'editGeneral'])->name('general-expenses.edit');
    Route::put('/expenses/{expense}/update-general', [ExpenseController::class, 'updateGeneral'])->name('general-expenses.update');

    // CRUD для статей расходов
    Route::get('/expenses/{expense}/create-item', [ExpenseController::class, 'createItem'])->name('expense-items.create');
    Route::post('/expenses/{expense}/store-item', [ExpenseController::class, 'storeItem'])->name('expense-items.store');
    Route::get('/expense-items/{expenseItem}/edit', [ExpenseController::class, 'editItem'])->name('expense-items.edit');
    Route::put('/expense-items/{expenseItem}', [ExpenseController::class, 'updateItem'])->name('expense-items.update');
});

//**************************************************************************************************************





Route::get('/v1/expenses', [App\Http\Controllers\V1\ExpenseController::class, 'index'])->name('v1expenses.index');

Route::middleware('auth')->group(function () {
    Route::get('/v1/expenses/create', [App\Http\Controllers\V1\ExpenseController::class, 'create'])->name('v1expenses.create');
    Route::post('/v1/expenses', [App\Http\Controllers\V1\ExpenseController::class, 'store'])->name('v1expenses.store');
    Route::get('/v1/expenses/{expense}/edit', [App\Http\Controllers\V1\ExpenseController::class, 'edit'])->name('v1expenses.edit');
    Route::put('/v1/expenses/{expense}', [App\Http\Controllers\V1\ExpenseController::class, 'update'])->name('v1expenses.update');
});
