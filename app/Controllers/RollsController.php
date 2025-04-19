<?php

namespace App\Controllers;

use App\Models\Roll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RollsController {
  function index(Request $request) {
    return Roll::all();
  }

  // only for seeding the valid rolls
  function create(Request $request) {
    $payload = Roll::validate($request);
    return Roll::create($payload);
  }

  function assign(Request $request) {
    $frameId = $request->input('frame_id');
    $rollIds = $request->input('roll_ids');
    $frame = Auth::user()->frames()->findOrFail($frameId);
    $frame->tags()->sync($rollIds);
    return $frame->fresh();
  }
}
