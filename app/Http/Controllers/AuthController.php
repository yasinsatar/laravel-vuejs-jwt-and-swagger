<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'email' => 'required|string|email|unique:users',
      'password' => 'required|string|confirmed',
    ]);

    $user = new User([
      'name' => $request->name,
      'email' => $request->email,
      'password' => md5($request->password),
    ]);
    $user = $user->save();

    $credentials = ['email' => $request->email, 'password' => $request->password];
    if (!Auth::attempt($credentials)) {
      return response()->json([
        'message' => 'Failed to login. Check the information.'
      ], 401);
    }

    $user = $request->user();

    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->token;
    if ($request->remember_me) {
      $token->expires_at = Carbon::now()->addWeeks(1);
    }
    $token->save();

    return response()->json([
      'success' => true,
      'id' => $user->id,
      'name' => $user->name,
      'access_token' => $tokenResult->accessToken,
      'token_type' => 'Bearer',
      'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDataTimeString()
    ], 201);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
      'remember_me' => 'boolean',
    ]);

    $credentials = request(['email', 'password']);
    if (!Auth::attempt($credentials)) {
      return response()->json([
        'message' => 'Failed to login. Check the information.'
      ], 401);
    }

    $user = $request->user();
    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->token;
    if ($request->remember_me) {
      $token->expires_at = Carbon::now()->addWeeks(1);
    }
    $token->save();
    return response()->json([
      'success' => true,
      'id' => $user->id,
      'name' => $user->name,
      'access_token' => $tokenResult->accessToken,
      'token_type' => 'Bearer',
      'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDataTimeString()
    ], 201);

  }

  public function logout(Request $request){
    $request->user()->token()->revoke();
    return response()->json([
      'message'=> 'Logged out'
    ]);
  }

  public function user(Request $request){
    return response()->json($request->user(),201);
  }


}
