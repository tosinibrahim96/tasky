<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait TaskRequestValidator
{

  /**
   * Validate data sent for creating a new task.
   * @param Request $request
   * @return Array $result
   */
  function validateCreateTask($request)
  {
    $result = ["status" => true, "data" => null];
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:3|string',
      'description' => 'required|min:3|string',
      'status' => ['required', Rule::in(['pending', 'in-progress', 'done'])],
      'project_id' => 'required|uuid',
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
   * Validate data sent for upadating details of an existing task.
   * @param Request $request
   * @param Task $task
   * @return Array $result
   */
  function validateUpdateTask($request, $task)
  {
    $result = ["status" => true, "data" => null];
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:3|string|unique:tasks,name,' . $task->id,
      'description' => 'required|min:3|string',
      'status' => ['required', Rule::in(['pending', 'in-progress', 'done'])],
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
