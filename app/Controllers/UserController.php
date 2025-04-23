<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController {
  function index(Request $request) {
    $query = User::query();

    // filter by id (hide e-mail sensitive information)
    $id = $request->input('id');
    if($id) return $query->where('id', $id)->firstOrFail()->makeHidden('email');

    // filter by username
    $username = $request->input('username');
    if($username) $query->where('username', 'like', '%' . $username . '%');

    // if no filters are provided return the Authorized User
    if(!$id && !$username){
      return Auth::user();
    }

    // filtered users (hide e-mail sensitive information)
    return $query->get()->makeHidden('email');
  }

  function create(Request $request) {
    $payload = User::validate($request);
    $user = User::create($payload);
    return $user;
  }

  function update(Request $request) {
    $user = Auth::user();
    $payload = User::validate($request);
    $user->update($payload);
    return $user;
  }

  function destroy(Request $request) {
    $user = Auth::user();
    $user->delete();
    return $user;
  }
}
