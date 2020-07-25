<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\AuthRequestValidator;
use App\Http\Traits\ApiResponse;
use App\User;
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
}
