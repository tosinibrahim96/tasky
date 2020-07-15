<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Project;
use App\Payment;
use App\Task;
use App\Http\Traits\ApiResponse;
use Faker\Generator as Faker;


class DashboardController extends Controller
{

  use ApiResponse;

  /**
   * Get dashboard info.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $faker = new Faker;
    $faker->addProvider(new \Faker\Provider\en_NG\Person($faker));
    $name = $faker->name;
    $projects = Project::all()->count();
    $tasks = Task::all()->count();
    $total_amount_received = Payment::sum('amount_received');
    $total_amount_expected = Project::sum('amount_expected');

    return $this->successResponseWithData(compact('projects', 'tasks', 'total_amount_received', 'total_amount_expected', 'name'), 200, 'Dashboard info retrieved');
  }
}
