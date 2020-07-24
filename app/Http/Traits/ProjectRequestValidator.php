<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait ProjectRequestValidator
{

  /**
   * Validate data sent for creating a new project.
   * @param Request $request
   * @return Array $result
   */

  function validateCreateProject($request)
  {
    $result = ["status" => true, "data" => null];
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:3|string|unique:projects',
      'description' => 'required|min:3|string',
      'amount_received' => 'required|numeric',
      'amount_expected' => 'required|numeric|gte:amount_received'
    ]);

    if ($validator->fails()) {
      $result['status'] = false;
      $result['data'] = $validator->errors()->all();
      return $result;
    } else {
      return $result;
    }
  }


  /**
   * Validate data sent for updating an existing project.
   * @param Request $request
   * @param Project $project
   * @return Array $result
   */
  function validateUpdateProject($request, $project)
  {
    $result = ["status" => true, "data" => null];
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:3|string|unique:projects,name,' . $project->id,
      'description' => 'required|min:3|string',
      'amount_expected' => 'required|numeric'
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
