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

  Route::get('/followers', [FollowersController::class, 'index']);
  Route::post('/followers', [FollowersController::class, 'create']);
  Route::patch('/followers', [FollowersController::class, 'update']);
  Route::delete('/followers', [FollowersController::class, 'destroy']);

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

  Route::get('/development-labs', [DevelopmentLabsController::class, 'index']);
  Route::post('/development-labs', [DevelopmentLabsController::class, 'create']);
  Route::patch('/development-labs', [DevelopmentLabsController::class, 'update']);
  Route::delete('/development-labs', [DevelopmentLabsController::class, 'destroy']);
  
  Route::get('/film-stocks', [FilmStocksController::class, 'index']);
  Route::post('/film-stocks', [FilmStocksController::class, 'create']);
  Route::patch('/film-stocks', [FilmStocksController::class, 'update']);
  Route::delete('/film-stocks', [FilmStocksController::class, 'destroy']);

  Route::get('/lenses', [LensesController::class, 'index']);
  Route::post('/lenses', [LensesController::class, 'create']);
  Route::patch('/lenses', [LensesController::class, 'update']);
  Route::delete('/lenses', [LensesController::class, 'destroy']);

  Route::get('/cameras', [CamerasController::class, 'index']);
  Route::post('/cameras', [CamerasController::class, 'create']);
  Route::patch('/cameras', [CamerasController::class, 'update']);
  Route::delete('/cameras', [CamerasController::class, 'destroy']);

  Route::post('/uploads', [UploadsController::class, 'create']);
  Route::delete('/uploads', [UploadsController::class, 'destroy']);
});