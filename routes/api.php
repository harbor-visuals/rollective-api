<?php

use App\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Controllers\UserController;
use App\Controllers\FramesController;
use App\Controllers\CommentsController;
use App\Controllers\RollsController;
use App\Controllers\UploadsController;

// Public (guest) endpoints
// Authentication
Route::post('/auth/login', [AuthController::class, 'login']);
// User Management
Route::post('/user', [UserController::class, 'create']);

// Protected endpoints (require authentication)
Route::middleware(['auth:sanctum'])->group(function () {
  // Authentication
  Route::post('/auth/logout', [AuthController::class, 'logout']);

  // User Management
  Route::get('/user', [UserController::class, 'index']);
  Route::patch('/user', [UserController::class, 'update']);
  Route::delete('/user', [UserController::class, 'destroy']);

  // Frames (posts)
  Route::get('/frames', [FramesController::class, 'index']);
  Route::post('/frames', [FramesController::class, 'create']);
  Route::patch('/frames', [FramesController::class, 'update']);
  Route::delete('/frames', [FramesController::class, 'destroy']);

  // Comments
  Route::get('/comments', [CommentsController::class, 'index']);
  Route::post('/comments', [CommentsController::class, 'create']);
  Route::patch('/comments', [CommentsController::class, 'update']);
  Route::delete('/comments', [CommentsController::class, 'destroy']);

  // Rolls (categories)
  Route::get('/rolls', [RollsController::class, 'index']);
  Route::put('/rolls/assign', [RollsController::class, 'assign']);

  // Image uploads
  Route::post('/uploads', [UploadsController::class, 'create']);
  Route::delete('/uploads', [UploadsController::class, 'destroy']);
});
