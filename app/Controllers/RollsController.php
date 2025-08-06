<?php

/**
 * This file contains the RollsController, which handles the CRUD operations for the rolls.
 */

namespace App\Controllers;

use App\Models\Roll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RollsController
{
  // the index method handles the read operation of rolls and is triggered by the "/rolls" endpoint via the "GET" HTTP method
  function index(Request $request)
  {
    return Roll::all();
  }

  // the create method handles the create operation of rolls and is not triggered by an endpoint (only for seeding purposes)
  function create(Request $request)
  {
    $payload = Roll::validate($request);
    return Roll::create($payload);
  }

  // the assign method handles the assignment operation of a frame to rolls and is triggered by the "/rolls/assign" endpoint via the "PUT" HTTP method
  function assign(Request $request)
  {
    $frameId = $request->input('frame_id');
    $rollIds = $request->input('roll_ids');
    $frame = Auth::user()->frames()->findOrFail($frameId);
    $frame->rolls()->sync($rollIds);
    return $frame->fresh();
  }
}
