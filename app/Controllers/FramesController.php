<?php

namespace App\Controllers;

use App\Models\Frame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FramesController
{
  function index(Request $request)
  {
    $query = Frame::query();

    // filter by id
    $id = $request->input('id');
    if ($id) return $query->where('id', $id)->firstOrFail();

    // filter by user
    $userId = $request->input('user_id');
    if ($userId) $query->where('user_id', $userId);

    // filter by slug
    $slug = $request->input('slug');
    if ($slug) $query->where('slug', $slug);

    // filter by rolls
    $rollIds = $request->input('roll_ids');
    if ($rollIds) {
      $rollIds = explode(',', $rollIds);
      $query->whereHas(
        'rolls',
        fn($q) => $q->whereIn('rolls.id', $rollIds),
        '>=',
        count($rollIds)
      );
    }

    // order
    $orderBy = $request->input('order_by', 'created_at');
    $orderDir = $request->input('order_dir', 'asc');
    $query->orderBy($orderBy, $orderDir);

    // pagination (instead of limit + offset)
    return $query->paginate(
      $request->input('limit', 20),   // results per page
      ['*'],                          // select all columns
      'page',                         // page query param name
      $request->input('page', 1)      // current page
    );
  }

  function create(Request $request)
  {
    $payload = Frame::validate($request);

    // generate slug
    $slug = Frame::generateSlug(Auth::user()->name, $payload['caption']);

    // add slug to payload
    $payload['slug'] = $slug;

    $frame = Auth::user()->frames()->create($payload);
    return $frame;
  }

  function update(Request $request)
  {
    $payload = Frame::validate($request);
    $id = $request->input('id');
    $frame = Auth::user()->frames()->findOrFail($id);

    // regenerate slug (only if caption was changed)
    if (isset($payload['caption'])) {
      // generate new slug
      $slug = Frame::generateSlug(Auth::user()->name, $payload['caption']);

      // add slug to payload
      $payload['slug'] = $slug;
    }

    $frame->update($payload);
    return $frame;
  }

  function destroy(Request $request)
  {
    $id = $request->input('id');
    $frame = Auth::user()->frames()->findOrFail($id);
    $frame->delete();
    return $frame;
  }
}
