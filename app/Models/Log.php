<?php

namespace App\Models;

use App\Casts\LocalizedDateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Log extends Model
{
  use HasFactory, AsSource, Filterable;

  protected $table = 'activity_log';

  public $guarded = [];

  protected $allowedSorts = [
    'id',
    'log_name',
    'causer_id',
    'updated_at',
    'created_at',
  ];

  protected $allowedFilters = [
    'log_name',
  ];

  protected $casts = [
    'properties' => 'collection',
    'created_at' => LocalizedDateTime::class . ':d-m-Y H:i:s',
    'updated_at' => LocalizedDateTime::class . ':d-m-Y H:i:s',
  ];

  public function subject()
  {
    if (config('activitylog.subject_returns_soft_deleted_models')) {
      return $this->morphTo()->withTrashed();
    }

    return $this->morphTo();
  }

  public function causer()
  {
    return $this->morphTo();
  }

  public function getExtraProperty($propertyName)
  {
    return Arr::get($this->properties->toArray(), $propertyName);
  }

  public function changes()
  {
    if (! $this->properties instanceof Collection) {
      return new Collection();
    }

    return $this->properties->only(['attributes', 'old']);
  }

  public function getChangesAttribute()
  {
    return $this->changes();
  }

  public function scopeInLog(Builder $query, ...$logNames)
  {
    if (is_array($logNames[0])) {
      $logNames = $logNames[0];
    }

    return $query->whereIn('log_name', $logNames);
  }

  public function scopeCausedBy(Builder $query, Model $causer)
  {
    return $query
    ->where('causer_type', $causer->getMorphClass())
    ->where('causer_id', $causer->getKey());
  }

  public function scopeForSubject(Builder $query, Model $subject)
  {
    return $query
    ->where('subject_type', $subject->getMorphClass())
    ->where('subject_id', $subject->getKey());
  }

}
