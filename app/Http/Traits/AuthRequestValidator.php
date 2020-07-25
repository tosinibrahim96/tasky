<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;

trait AuthRequestValidator
{

  /**
   * Validate data sent for creating a new user account.
   * @param Request $request
   * @return Array $result
   */

  function validateRegister($request)
  {
    $result = ["status" => true, "data" => null];
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:users',
      'username' => 'required|string|unique:users',
      'password' => 'required|string|min:6'
    ]);

    if ($validator->fails()) {
      $result['status'] = false;
      $result['data'] = $validator->errors()->all();
      return $result;
    } else {
      return $result;
    }
  }
}
