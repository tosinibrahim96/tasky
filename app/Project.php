<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\UsesUuid;

class Project extends Model
{
  use UsesUuid, SoftDeletes;

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];
  protected $hidden = ['updated_at', 'deleted_at'];
  /**
   * Get the tasks for the Project.
   */
  public function tasks()
  {
    return $this->hasMany(Task::class)->orderByDesc('updated_at');
  }

  /**
   * Get the payments for the Project.
   */
  public function payments()
  {
    return $this->hasMany(Payment::class)->orderByDesc('updated_at');
  }

  /**
   * Get the latest Payment info.
   */
  public function lastPaymentUpdate()
  {
    return $this->hasMany(Payment::class)->orderByDesc('updated_at')->first();
  }

  /**
   * Get number of completed tasks.
   */
  public function copletedTasksCount()
  {
    return $this->hasMany(Task::class)->where('status', 'done')->count();
  }

  /**
   * Get total number of tasks for this project.
   */
  public function totalTasksCount()
  {
    return $this->hasMany(Task::class)->count();
  }
}
