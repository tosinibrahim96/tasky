<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Project;
use App\Payment;
use App\Http\Traits\ApiResponse;
use App\Http\Traits\ProjectRequestValidator;
use Illuminate\Http\Request;
use Faker\Generator as Faker;


class ProjectController extends Controller
{

  use ApiResponse, ProjectRequestValidator;

  /**
   * Display a list of projects(paginated).
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $projects = Project::orderByDesc('updated_at')->paginate();

    foreach ($projects as $project) {
      $project->last_payment = $project->lastPaymentUpdate();
      $project->completed_tasks = $project->copletedTasksCount();
      $project->total_tasks = $project->totalTasksCount();
    }
    return $this->successResponseWithData($projects, 200, 'Projects retrieved successfully');
  }

  /**
   * Store a new project.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $validatedData = $this->validateCreateProject($request);
    if (!$validatedData['status']) {
      $errors = $validatedData['data'];
      return $this->failureResponse(400, compact('errors'));
    }

    $project = new Project;
    $payment = new Payment;
    $faker = new Faker;
    $faker->addProvider(new \Faker\Provider\en_NG\Person($faker));

    $project->name = $request->name;
    $project->description = $request->description;
    $project->amount_expected = $request->amount_expected;
    $project->save();

    $payment->updated_by = $faker->name;
    $payment->amount_received = $request->amount_received;
    $payment->project_id = $project->id;
    $payment->save();

    return $this->successResponseWithData($project->load('payments', 'tasks'), 200, 'Project created successfully');
  }

  /**
   * Display single Project info.
   *
   * @param  String  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $project = Project::find($id);
    if (!$project) {
      return $this->failureResponse(404, 'Project Not Found');
    }
    return $this->successResponseWithData($project->load('payments', 'tasks'), 200, 'Project retrieved successfully');
  }

  /**
   * Update project details.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  String  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {

    $project = Project::find($id);
    if (!$project) {
      return $this->failureResponse(404, 'Project Not Found');
    }

    $validatedData = $this->validateUpdateProject($request, $project);
    if (!$validatedData['status']) {
      $errors = $validatedData['data'];
      return $this->failureResponse(400, compact('errors'));
    }

    $project->name = $request->name;
    $project->description = $request->description;
    $project->amount_expected = $request->amount_expected;
    $project->save();

    return $this->successResponseWithData($project->load('payments', 'tasks'), 200, 'Project details updated');
  }

  /**
   * Remove a project from the system(Soft delete).
   *
   * @param  String  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $project = Project::find($id);
    if (!$project) {
      return $this->failureResponse(404, 'Project Not Found');
    }

    $project->delete();
    return $this->successResponseWithoutData(200, 'Project deleted successfully');
  }
}
