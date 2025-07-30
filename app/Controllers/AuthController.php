<?php

/**
 * This file contains the AuthController, which handles user authentication through login and logout methods.
 * The login method uses a username and password to authenticate the user and returns a bearer token.
 */

namespace App\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController
{
  // the login method handles the user authentication and is triggered by the "/auth/login" endpoint
  function login(Request $request)
  {
    $username = $request->input('username');
    $password = $request->input('password');

    $user = User::where('username', $username)->first();
    if (!$user)
      return abort(404, 'no such user');
    if (!Hash::check($password, $user->password))
      return abort(401, 'wrong password');

    $token = $user->createToken('bearer');
    return [
      'token' => $token->plainTextToken,
      'user' => $user,
    ];
  }

  // the logout method handles the user logout and is triggered by the "/auth/logout" endpoint
  function logout(Request $request)
  {
    $user = Auth::user();
    $user->tokens()->delete();
    return $user;
  }
}
