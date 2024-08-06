<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;


Route::view('/', 'home');
Route::view('/contact','contact');

// Route::controller(JobController::class)->group(function(){
//     Route::get('/jobs','index');
//     Route::get('/jobs/create','create');
//     Route::get('/jobs/{job}','show');
//     Route::post('/jobs','store');
//     Route::get('/jobs/{job}/edit','edit');
//     Route::patch('/jobs/{job}','update');
//     Route::delete('/jobs/{job}','destroy');
// });

Route::resource('jobs', JobController::class,[
    'only' => ['index','create','show','store','edit', 'update', 'destroy'] //i made this to learn
    // 'except =>[]
]);

//Auth
Route::get('/register', [RegisteredUserController::class,'create']);
Route::post('/register', [RegisteredUserController::class,'store']);

Route::get('/login', [SessionController::class,'create']);
Route::post('/login', [SessionController::class,'store']);
Route::post('/logout', [SessionController::class,'destroy']);



// example for a slug uri
// Route::get('posts/{post:slug}', function(Post $post){});
