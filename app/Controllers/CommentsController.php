<?php

namespace App\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController {
  function index(Request $request) {
    $query = Comment::query();

    // filter by user
    $userId = $request->input('user_id');
    if ($userId) $query->where('user_id', $userId);

    // filter by frame
    $frameId = $request->input('frame_id');
    if ($frameId) $query->where('frame_id', $frameId);

    return $query->get();
  }

  function create(Request $request) {
    $payload = Comment::validate($request);
    $comment = Auth::user()->comments()->create($payload);
    return $comment;
  }

  function update(Request $request) {
    $payload = Comment::validate($request);
    $id = $request->input('id');
    $comment = Auth::user()->comments()->findOrFail($id);
    $comment->update($payload);
    return $comment;
  }

  function destroy(Request $request) {
    $id = $request->input('id');
    $comment = Auth::user()->comments()->findOrFail($id);
    $comment->delete();
    return $comment;
  }
}
