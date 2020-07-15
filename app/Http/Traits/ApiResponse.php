<?php

namespace App\Http\Traits;

trait ApiResponse
{


  function successResponseWithData($data, $statusCode, $message)
  {
    return response()->json(["data" => $data, "status" => true, "message" => $message], $statusCode);
  }


  function successResponseWithoutData($statusCode, $message)
  {
    return response()->json(["status" => true, "message" => $message], $statusCode);
  }

  function failureResponse($statusCode, $message)
  {
    return response()->json(["status" => false, "message" => $message], $statusCode);
  }
}
