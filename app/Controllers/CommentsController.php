<?php

/**
 * This file contains the CommentsController, which handles the CRUD operations for the frame comments.
 */

namespace App\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController
{

  // the index method handles the read operation of comments and is triggered by the "/comments" endpoint via the "GET" HTTP method
  function index(Request $request)
  {
    $query = Comment::query();

    // filter by user
    $userId = $request->input('user_id');
    if ($userId) $query->where('user_id', $userId);

    // filter by frame
    $frameId = $request->input('frame_id');
    if ($frameId) $query->where('frame_id', $frameId);

    // limit, offset
    $limit = $request->input('limit', 1000);
    $offset = $request->input('offset', 0);
    $query->limit($limit);
    $query->offset($offset);

    return $query->get();
  }

  // the create method handles the create operation of comments and is triggered by the "/comments" endpoint via the "POST" HTTP method
  function create(Request $request)
  {
    $payload = Comment::validate($request);
    $comment = Auth::user()->comments()->create($payload);
    return $comment;
  }

  // the update method handles the update operation of comments and is triggered by the "/comments" endpoint via the "PATCH" HTTP method
  function update(Request $request)
  {
    $payload = Comment::validate($request);
    $id = $request->input('id');
    $comment = Auth::user()->comments()->findOrFail($id);
    $comment->update($payload);
    return $comment;
  }

  // the destroy method handles the delete operation of comments and is triggered by the "/comments" endpoint via the "DELETE" HTTP method
  function destroy(Request $request)
  {
    $id = $request->input('id');
    $comment = Auth::user()->comments()->findOrFail($id);
    $comment->delete();
    return $comment;
  }
}
