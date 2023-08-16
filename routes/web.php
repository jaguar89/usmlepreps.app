<?php

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);


Route::middleware('auth')->group(function () {

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/systems', [\App\Http\Controllers\SystemController::class, 'index'])->name('systems');
        Route::get('/systems/create', [\App\Http\Controllers\SystemController::class, 'create'])->name('systems.create');
        Route::post('/systems', [\App\Http\Controllers\SystemController::class, 'store'])->name('system.create');
        Route::put('/systems/{system}', [\App\Http\Controllers\SystemController::class, 'update'])->name('system.update');
        Route::get('/systems/{system}', [\App\Http\Controllers\SystemController::class, 'edit'])->name('systems.edit');
        Route::delete('/systems/{system}', [\App\Http\Controllers\SystemController::class, 'destroy'])->name('systems.destroy');

        Route::get('/tests', [\App\Http\Controllers\TestController::class, 'index'])->name('tests');
        Route::post('/tests', [\App\Http\Controllers\TestController::class, 'store']);
    });

//    Route::get('/tests', [\App\Http\Controllers\TestController::class, 'index'])->name('tests');
    Route::get('/tests/{id}', [\App\Http\Controllers\TestController::class, 'show']);
});

require __DIR__ . '/auth.php';
