<?php

/**
 * This file contains the UploadsController, which handles the CRUD operations for the uploads.
 */

namespace App\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadsController
{
  // the create method handles the create operation of uploads and is triggered by the "/uploads" endpoint via the "POST" HTTP method
  function create(Request $request)
  {
    // NOTE: file media in php only work for POST requests!
    $user = Auth::user();
    $file = $request->file('file');

    // Generate SHA256 hash
    // https://laravel.com/docs/12.x/strings#method-str-uuid
    $fileCode = Str::uuid();

    // Preserve the original extension
    $extension = $file->getClientOriginalExtension();
    $codedFilename = $fileCode . '.' . $extension;

    // Store the uploaded file in a user-specific folder with a custom filename (media/images/user_id/codedFilename)
    Storage::putFileAs(
      'media/images/' . $user->id,
      $file,
      $codedFilename,
    );

    $pathname = "media/images/{$user->id}/{$codedFilename}";

    // Generate full HTTP URL
    $fullUrl = url(Storage::url($pathname));

    return response()->json(['codedFilename' => $codedFilename, 'url' => $fullUrl]);
  }

  // the destroy method handles the delete operation of uploads and is triggered by the "/uploads" endpoint via the "DELETE" HTTP method
  function destroy(Request $request)
  {
    $user = Auth::user();
    $codedFilename = $request->input('codedFilename');
    $path = 'media/images/' . $user->id . '/' . $codedFilename;
    if (!Storage::exists($path))
      return response()->json(['success' => false, 'error' => 'File does not exist'], 404);
    Storage::delete($path);
    return response()->json([
      'success' => true,
      'deleted' => $path,
    ]);
  }
}
