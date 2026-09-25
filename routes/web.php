<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Office\CorrespondenceController;
use App\Http\Controllers\Web\Office\DocumentGeneratorController;
use App\Http\Controllers\Web\Office\IncomingLetterController;
use App\Http\Controllers\Web\Office\OutgoingLetterController;
use Illuminate\Support\Facades\Route;

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


    // Office Correspondence Module
    Route::middleware(['auth'])
        ->prefix('office/correspondence')
        ->name('office.correspondence.')
        ->group(function () {

            // Correspondence Dashboard pending
            Route::get('/', [CorrespondenceController::class, 'index'])
                ->name('index');

        // ১. আগত চিঠি রুট (Incoming Letters)  pending
        Route::get('/incoming', [IncomingLetterController::class, 'index'])->name('incoming.index');
        Route::get('/incoming/create', [IncomingLetterController::class, 'create'])->name('incoming.create');

        // ২. প্রেরিত চিঠি রুট (Outgoing Letters) pending
        Route::get('/outgoing', [OutgoingLetterController::class, 'index'])->name('outgoing.index');
        Route::get('/outgoing/create', [OutgoingLetterController::class, 'create'])->name('outgoing.create');


        //module-02

        });

        Route::middleware(['auth'])->group(function () {
             Route::get('/documents/generator', [DocumentGeneratorController::class, 'create'])->name('documents.create');
        });

require __DIR__.'/auth.php';
