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

//            $user = \App\Models\User::find(2);
//            $tests = \App\Models\Test::all();
//            foreach ($tests as $test) {
//                $user->tests()->attach($test->id, ['completed' => false]);
//            }
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/systems', [\App\Http\Controllers\SystemController::class, 'index'])->name('systems');
        Route::get('/systems/create', [\App\Http\Controllers\SystemController::class, 'create'])->name('systems.create');
        Route::post('/systems', [\App\Http\Controllers\SystemController::class, 'store'])->name('systems.store');
        Route::put('/systems/{system}', [\App\Http\Controllers\SystemController::class, 'update'])->name('systems.update');
        Route::get('/systems/edit/{system}', [\App\Http\Controllers\SystemController::class, 'edit'])->name('systems.edit');
        Route::delete('/systems/{system}', [\App\Http\Controllers\SystemController::class, 'destroy'])->name('systems.destroy');

        Route::get('/tests', [\App\Http\Controllers\TestController::class, 'index'])->name('tests');
        Route::get('/tests/create', [\App\Http\Controllers\TestController::class, 'create'])->name('tests.create');
        Route::get('/tests/edit/{test}', [\App\Http\Controllers\TestController::class, 'edit'])->name('tests.edit');
        Route::delete('/tests/{test}', [\App\Http\Controllers\TestController::class, 'edit'])->name('tests.destroy');
        Route::post('/tests', [\App\Http\Controllers\TestController::class, 'store'])->name('tests.store');
        Route::put('/tests/{test}', [\App\Http\Controllers\TestController::class, 'store'])->name('tests.update');
    });

    Route::get('/tests/{id}', [\App\Http\Controllers\TestController::class, 'show']);
    Route::post('/complete-test/{testId}', [\App\Http\Controllers\TestController::class, 'completeTest'])->name('complete.test');

    Route::get('/view_tests/{id}', [\App\Http\Controllers\HomeController::class, 'viewDetails']);
});

require __DIR__ . '/auth.php';
