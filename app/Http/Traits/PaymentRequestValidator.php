<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;

trait PaymentRequestValidator
{

  /**
   * Validate data sent for creating a new payment record.
   * @param Request $request
   * @return Array $result
   */

  function validateCreatePayment($request)
  {
    $result = ["status" => true, "data" => null];
    $validator = Validator::make($request->all(), [
      'updated_by' => 'required|min:3|string',
      'amount_received' => 'required|numeric',
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
