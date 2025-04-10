<?php

use App\Controllers\AuthController;
use App\Controllers\CommentsController;
use App\Controllers\TagsController;
use Illuminate\Support\Facades\Route;
use App\Controllers\ExamplesController;
use App\Controllers\ArticlesController;
use App\Controllers\UserController;
use App\Controllers\UploadsController;
use App\Controllers\MailsController;

// guest endpoints
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/user', [UserController::class, 'create']);

// user endpoints
Route::middleware(['auth:sanctum'])->group(function () {
  Route::post('/auth/logout', [AuthController::class, 'logout']);

  Route::get('/user', [UserController::class, 'index']);
  Route::patch('/user', [UserController::class, 'update']);
  Route::delete('/user', [UserController::class, 'destroy']);

  Route::get('/frames', [FramesController::class, 'index']);
  Route::post('/frames', [FramesController::class, 'create']);
  Route::patch('/frames', [FramesController::class, 'update']);
  Route::delete('/frames', [FramesController::class, 'destroy']);

  Route::get('/comments', [CommentsController::class, 'index']);
  Route::post('/comments', [CommentsController::class, 'create']);
  Route::patch('/comments', [CommentsController::class, 'update']);
  Route::delete('/comments', [CommentsController::class, 'destroy']);

  Route::get('/rolls', [RollsController::class, 'index']);
  Route::post('/rolls', [RollsController::class, 'create']);
  Route::patch('/rolls', [RollsController::class, 'update']);
  Route::delete('/rolls', [RollsController::class, 'destroy']);

  Route::post('/uploads', [UploadsController::class, 'create']);
  Route::delete('/uploads', [UploadsController::class, 'destroy']);
});