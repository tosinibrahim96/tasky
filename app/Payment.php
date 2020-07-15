<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;


class Payment extends Model
{
  use UsesUuid;

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ["created_at", "project_id"];
}
