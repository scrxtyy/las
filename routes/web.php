<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountsController;
use Illuminate\Support\Facades\Route;
use App\Models\Leave_Application;

Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
})->middleware(['auth'])->name('logout');
Route::get('/admin', function () {
    if (auth()->check() && auth()->user()->usertype === 'admin' || auth()->user()->usertype === 'Super-Admin') {
        $tickets = Leave_Application::where('status', 'PENDING')->orderBy("created_at","DESC")->get();
        return view('admin.index')->with('tickets', $tickets);
    } else {
        return redirect()->route('employee.dashboard');
    }
})->middleware(['auth'])->name('admin.dashboard');
Route::redirect('/', destination:'login');
Route::middleware('auth','admin')->group(function () {
    Route::get('/admin/employees', [AccountsController::class, 'index'])->name('users');
    Route::get('/admin/tickets/approved', [AccountsController::class, 'approved'])->name('tickets.approved');
    Route::get('/admin/tickets/rejects', [AccountsController::class, 'rejects'])->name('tickets.rejected');
    Route::post('/create/employees', [AccountsController::class, 'createUsers'])->name('userCreate');
    Route::post('/tickets/approve/{id}', [AccountsController::class, 'approve'])->name('tickets.approve');
    Route::post('/tickets/delete/{id}', [AccountsController::class, 'delete'])->name('tickets.delete');
    Route::get('/users/search', [AccountsController::class, 'search'])->name('users.search');
    Route::post('/create/employees', [AccountsController::class, 'createUsers'])->name('userCreate');
    Route::delete('/employees/delete/{id}', [AccountsController::class, 'destroy'])->name('employees.destroy');
});
Route::middleware('auth','employee')->group(function () {
    Route::get('/employee', [AccountsController::class, 'dashboard_employee'])->name('employee.dashboard');
    Route::get('/employees/leave/apply', [AccountsController::class, 'apply'])->name('apply');
    Route::post('/employees/leave/submit', [AccountsController::class, 'submitApply'])->name('leaveCreate');
});
Route::get('/preview/{id}', [AccountsController::class, 'preview']);
require __DIR__.'/auth.php';
