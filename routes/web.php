<?php

use App\Http\Controllers\Poll\FillOutController;
use App\Http\Controllers\Poll\LatestPollController;
use App\Http\Controllers\Poll\MyPolllController;
use App\Http\Controllers\Poll\PollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Result\ResultController;
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
    return view('auth.login');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {

    Route::get('polls/latest', LatestPollController::class)->name('polls.latest');
    Route::get('polls/my-polls', MyPolllController::class)->name('polls.mine');
    Route::get('polls/fill-out/{id}',  [FillOutController::class, 'getPoll'])->name('polls.fill_out');
    Route::post('polls/fill-out/{poll}',  [FillOutController::class, 'postPollSingle'])->name('polls.fill_out_post');
    Route::post('polls/fill-out/{poll}/{page}',  [FillOutController::class, 'postPollMultiple'])->name('polls.fill_out_post_multiple');
    Route::resource('polls', PollController::class);
    Route::get('polls/result/{poll}', [ResultController::class, 'index'])->name('polls.result');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__.'/auth.php';
