<?php

/**
 * This file contains the UserController, which handles the CRUD operations for the users.
 */

namespace App\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
  // the index method handles the read operation of users and is triggered by the "/user" endpoint via the "GET" HTTP method
  function index(Request $request)
  {
    $query = User::query();

    // filter by id (hide e-mail sensitive information)
    $id = $request->input('id');
    if ($id) return $query->where('id', $id)->firstOrFail()->makeHidden('email');

    // filter by username
    $username = $request->input('username');
    if ($username) $query->where('username', 'like', '%' . $username . '%');

    // if no filters are provided return the Authorized User
    if (!$id && !$username) {
      return Auth::user();
    }

    // filtered users (hide e-mail sensitive information)
    return $query->get()->makeHidden('email');
  }

  // the create method handles the create operation of users and is triggered by the "/user" endpoint via the "POST" HTTP method
  function create(Request $request)
  {
    $payload = User::validate($request);
    $user = User::create($payload);
    if (!$user) {
      return response()->json(['message' => 'User creation failed'], 500);
    }
    return $user;
  }

  // the update method handles the update operation of users and is triggered by the "/user" endpoint via the "PATCH" HTTP method
  function update(Request $request)
  {
    $user = Auth::user();
    $payload = User::validate($request);
    $user->update($payload);
    return $user;
  }

  // the destroy method handles the delete operation of users and is triggered by the "/user" endpoint via the "DELETE" HTTP method
  function destroy(Request $request)
  {
    $user = Auth::user();
    $user->delete();
    return $user;
  }
}
