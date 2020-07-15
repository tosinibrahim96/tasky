<?php

use App\Project;
use App\Payment;
use Illuminate\Database\Seeder;


class PaymentSeeder extends Seeder
{

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $projects = Project::all();

    foreach ($projects as $project) {
      factory(Payment::class)->create([
        'project_id' => $project->id
      ]);
    }
  }
}
