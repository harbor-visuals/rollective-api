<?php

/**
 * This file contains the Comment (Model), which represents comments on frames and handles validation logic.
 */

namespace App\Models;

use Bootstrap\Column;
use Bootstrap\Model;
use Illuminate\Http\Request;

// Comment model representing a comment record in the database
class Comment extends Model
{
  // Comment Model Fields
  #[Column] public int $id;
  #[Column] public string $text;
  #[Column] public int $frame_id;
  #[Column] public int $user_id;
  #[Column] public string $created_at;
  #[Column] public string $updated_at;

  // Method validates request data (payload) for comments (create or update)
  static function validate(Request $request)
  {
    $post = $request->method() === 'POST';
    return $request->validate([
      'text' => ['required', 'min:1', 'max: 200'],
      'frame_id' => [($post ? 'required' : 'exclude'), 'exists:frames,id'],
    ]);
  }
}
