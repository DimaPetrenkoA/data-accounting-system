<?php

namespace App\Models;

use App\Casts\LocalizedDateTime;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{

  protected static function booted()
  {
    static::created(function ($user) {
      activity('user-create')->performedOn($user)->log("Добавил нового пользователя (\"$user->name\" ID: $user->id)");
    });

    static::deleted(function ($user) {
      activity('user-deleted')->performedOn($user)->log("Удалил пользователя (\"$user->name\" ID: $user->id)");
    });

    static::updated(function ($user) {
      if ($user->isDirty('name') || $user->isDirty('email') || $user->isDirty('password'))
      activity('user-update')->performedOn($user)->log("Обновил пользователя (\"$user->name\" ID: $user->id)");
    });
  }

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name',
    'email',
    'password',
    'permissions',
  ];

  /**
  * The attributes excluded from the model's JSON form.
  *
  * @var array
  */
  protected $hidden = [
    'password',
    'remember_token',
    'permissions',
  ];

  /**
  * The attributes that should be cast to native types.
  *
  * @var array
  */
  protected $casts = [
    'permissions'          => 'array',
    'email_verified_at'    => 'datetime',
    'created_at' => LocalizedDateTime::class . ':d-m-Y H:i:s',
    'updated_at' => LocalizedDateTime::class . ':d-m-Y H:i:s'
  ];

  /**
  * The attributes for which you can use filters in url.
  *
  * @var array
  */
  protected $allowedFilters = [
    'id',
    'name',
    'email',
    'permissions',
  ];

  /**
  * The attributes for which can use sort in url.
  *
  * @var array
  */
  protected $allowedSorts = [
    'id',
    'name',
    'email',
    'updated_at',
    'created_at',
  ];
}
