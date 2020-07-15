<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\Project::class, 5)->create()->each(function ($project) {
      $project->tasks()->save(factory(App\Task::class)->make());
      $project->tasks()->save(factory(App\Task::class)->make());
    });
  }
}
