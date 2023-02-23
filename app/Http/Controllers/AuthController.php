<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

  /**
   * @OA\Post(
   ** path="/api/auth/register",
   *   tags={"Register"},
   *   summary="Register",
   *   operationId="register",
   *
   *  @OA\Parameter(
   *      name="name",
   *      in="query",
   *      required=true,
   *      @OA\Schema(
   *           type="string"
   *      )
   *   ),
   *  @OA\Parameter(
   *      name="email",
   *      in="query",
   *      required=true,
   *      @OA\Schema(
   *           type="string"
   *      )
   *   ),
   *   @OA\Parameter(
   *      name="password",
   *      in="query",
   *      required=true,
   *      @OA\Schema(
   *           type="string"
   *      )
   *   ),
   *      @OA\Parameter(
   *      name="password_confirmation",
   *      in="query",
   *      required=true,
   *      @OA\Schema(
   *           type="string"
   *      )
   *   ),
   *   @OA\Response(
   *      response=201,
   *       description="Success",
   *      @OA\MediaType(
   *           mediaType="application/json",
   *      )
   *   ),
   *   @OA\Response(
   *      response=401,
   *       description="Unauthenticated"
   *   ),

   *)
   **/
  
 
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
      'token' => $tokenResult->accessToken,
      'token_type' => 'Bearer',
      'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
    ], 201);
  }


 /**
   * @OA\Post(
   ** path="/api/auth/login",
   *   tags={"Login"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *)
     **/
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
      'token' => $tokenResult->accessToken,
      'token_type' => 'Bearer',
      //'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
      'expires_at' => Carbon::parse($tokenResult->token->expires_at)->timestamp
    ], 201);
  }

  public function logout(Request $request)
  {
    $request->user()->token()->revoke();
    return response()->json([
      'message' => 'Logged out'
    ]);
  }

   /**
   * @OA\Get(
   ** path="/api/userDetail",
   *   tags={"userDetail"},
     *   summary="userDetail",
     *   operationId="userdetail",
     *   description="<strong>* You must Authorize with Bearer Token</strong>",
     *   security={{"token":{}}},
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *)
     **/
  public function user(Request $request)
  {
    return response()->json($request->user());
  }
}
