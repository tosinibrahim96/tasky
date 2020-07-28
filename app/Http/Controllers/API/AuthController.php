<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\AuthRequestValidator;
use App\Http\Traits\ApiResponse;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

  use AuthRequestValidator, ApiResponse;
  /**
   * Create a new account.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {


    $validatedData = $this->validateRegister($request);
    if (!$validatedData['status']) {
      $errors = $validatedData['data'];
      return $this->failureResponse(400, compact('errors'));
    }

    $password = Hash::make($request->password);
    $user = User::create(['username' => $request->username, 'password' => $password, 'email' => $request->email]);

    return $this->successResponseWithData(compact('user'), 201, 'User account created');
  }

  /**
   * Login.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {

    $validatedData = $this->validateLogin($request);
    if (!$validatedData['status']) {
      $errors = $validatedData['data'];
      return $this->failureResponse(400, compact('errors'));
    }

    if (filter_var($request->username_or_email, FILTER_VALIDATE_EMAIL)) {

      if (!$token = $this->getTokenFromEmail($request)) {
        return $this->failureResponse(401, 'Email or Password incorrect.');
      }
    } else {
      if (!$token = $this->getTokenFromUsername($request)) {
        return $this->failureResponse(401, 'Username or Password incorrect.');
      }
    }

    $user = Auth::user();
    return $this->successResponseWithData(compact('token', 'user'), 200, 'Login successful');
  }


  /** Generate token with email and password
   * @param  $request
   * @return $token
   */
  public function getTokenFromEmail($request)
  {
    $token = Auth::attempt(['email' => $request->username_or_email, 'password' => $request->password]);
    return $token;
  }


  /** Generate token with username and password
   * @param  $request
   * @return $token
   */
  public function getTokenFromUsername($request)
  {
    $token = Auth::attempt(['username' => $request->username_or_email, 'password' => $request->password]);
    return $token;
  }
}
