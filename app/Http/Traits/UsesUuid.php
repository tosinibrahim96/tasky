<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait UsesUuid
{
  /**
   * The static function named boot[TraitName] will be executed as the
   *  boot function of any elowuent model using this trait.
   * When creating a new record i.e static::creating, make use of (string) Str::uuid()
   * as primary key
   */
  protected static function bootUsesUuid()
  {
    static::creating(function ($model) {
      if (!$model->getKey()) {
        $model->{$model->getKeyName()} = (string) Str::uuid();
      }
    });
  }

  /**
   * Tells Laravel the primary key of any model using this trait
   * will not be incrementing (since we returned false)
   * @return Boolean
   */
  public function getIncrementing()
  {
    return false;
  }

  /**
   * Tells Laravel the primary we will be using will
   * be of type string
   * @return String
   */
  public function getKeyType()
  {
    return 'string';
  }
}
