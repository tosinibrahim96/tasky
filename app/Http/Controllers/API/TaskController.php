<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Traits\TaskRequestValidator;

class TaskController extends Controller
{
  use ApiResponse, TaskRequestValidator;
  /**
   * Display a list of tasks.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $tasks = Task::paginate();

    return $this->successResponseWithData($tasks, 200, 'Tasks retrieved successfully');
  }

  /**
   * Store a new task.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validatedData = $this->validateCreateTask($request);
    if (!$validatedData['status']) {
      $errors = $validatedData['data'];
      return $this->failureResponse(400, compact('errors'));
    }

    $taskNameExistForProject = Task::where('name', $request->name)->where('project_id', $request->project_id)->first();
    if ($taskNameExistForProject) {
      return $this->failureResponse(400, 'Task name already exist for project');
    }

    $task = new Task;

    $task->name = $request->name;
    $task->description = $request->description;
    $task->status = $request->status;
    $task->project_id = $request->project_id;
    $task->save();

    return $this->successResponseWithData($task, 200, 'Task saved successfully');
  }

  /**
   * Display single task info.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $task = Task::find($id);
    if (!$task) {
      return $this->failureResponse(404, 'Task Not Found');
    }
    return $this->successResponseWithData($task, 200, 'Task retrieved successfully');
  }

  /**
   * Update the task details.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $task = Task::find($id);
    if (!$task) {
      return $this->failureResponse(404, 'Task Not Found');
    }

    $validatedData = $this->validateUpdateTask($request, $task);
    if (!$validatedData['status']) {
      $errors = $validatedData['data'];
      return $this->failureResponse(400, compact('errors'));
    }

    $task->name = $request->name;
    $task->description = $request->description;
    $task->status = $request->status;
    $task->save();

    return $this->successResponseWithData($task, 200, 'Task details updated');
  }

  /**
   * Remove a task from the system(Soft delete).
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $task = Task::find($id);
    if (!$task) {
      return $this->failureResponse(404, 'Task Not Found');
    }

    $task->delete();
    return $this->successResponseWithoutData(200, 'Task deleted successfully');
  }
}
