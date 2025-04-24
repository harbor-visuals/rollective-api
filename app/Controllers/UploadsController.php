<?php

namespace App\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// basic media example
class UploadsController {
  function create(Request $request) {
    // NOTE: file media in php only work for POST requests!
    $user = Auth::user();
    $file = $request->file('file');

    // Generate SHA256 hash
    // https://laravel.com/docs/12.x/strings#method-str-uuid
    $fileCode = Str::uuid();

    // Preserve the original extension
    $extension = $file->getClientOriginalExtension();
    $codedFilename = $fileCode . '.' . $extension;

    Storage::putFileAs(
        'media/images/' . $user->id,
        $file,
        $codedFilename,
    );

    return response()->json(['codedFilename' => $codedFilename]);
  }

  function destroy(Request $request) {
    $user = Auth::user();
    $codedFilename = $request->input('codedFilename');
    $path = 'media/images/' . $user->id . '/' . $codedFilename;
    if (!Storage::exists($path))
      return abort(404, 'file does not exist');
    Storage::delete($path);
    return $path;
  }
}
