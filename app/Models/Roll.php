<?php

namespace App\Models;

use Bootstrap\Column;
use Bootstrap\Model;
use Illuminate\Http\Request;

// Roll model representing a roll (category) record in the database
class Roll extends Model
{
  // Roll Model Fields
  #[Column] public int $id;
  #[Column] public string $name;
  #[Column] public string $emoji;
  #[Column] public string $created_at;
  #[Column] public string $updated_at;

  // Method validates request data (payload) for rolls (create or update)
  static function validate(Request $request)
  {
    return $request->validate([
      'name' => ['required', 'min:1', 'max: 99', 'unique:rolls,name'],
      'emoji' => ['required', 'size:1'],
    ]);
  }
}
