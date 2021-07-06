<?php

namespace App\Models;

use App\Casts\LocalizedDateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class AllowedWork extends Model
{
  use HasFactory, AsSource, Attachable, Filterable;

  protected $table = 'allowed_work';

  protected $guarded = [];
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'ins_name',
    'ins_reg',
    'email',
    'phone',
    'actual_address',
    'currency',
    'company_position',
    'company_about',
    'status'
  ];

  protected static function booted()
  {
    static::created(function ($allowed_work) {
      activity('work-create')->performedOn($allowed_work)->log('Добавлена новая работа');
    });

    static::deleted(function ($allowed_work) {
      activity('work-deleted')->performedOn($allowed_work)->log('Удалена работа');
    });

    static::updated(function ($allowed_work) {
      activity('work-update')->performedOn($allowed_work)->log('Работа отредактирована');
    });
  }

  public function allowed_work() {
    return $this->hasMany(AllowedWork::class,'ins_reg','ins_reg');
  }

  public $casts = [
    'created_at' => LocalizedDateTime::class . ':d-m-Y H:i:s',
    'updated_at' => LocalizedDateTime::class . ':d-m-Y H:i:s'
  ];

  /**
  * The attributes for which can use sort in url.
  *
  * @var array
  */
  protected $allowedFilters = [
    'ins_name'
  ];

  /**
  * Name of columns to which http sorting can be applied
  *
  * @var array
  */
  protected $allowedSorts = [
    'ins_name',
    'ins_reg',
    'email',
    'phone',
    'actual_address',
    'currency',
    'company_position',
    'company_about',
    'status',
    'created_at',
    'updated_at'
  ];

  public function isInAllowedWorkRange($work) {
    $regexpWorkNumber = "/^([A-Za-z]+)([[:digit:]]+)$/";
    $matches = [];
    if (preg_match($regexpWorkNumber,$work,$matches)) {

      $serial = $matches[1];
      $number = $matches[2];

      $rangesForStrah = $this->allowed_work->where('range_serial',$serial);

      foreach ($rangesForStrah as $range) {
        if ($number >= $range->range_from && $number <= $range->range_to) {
          return true;
        }
      }
    }

    return false;
  }
}
