<?php

namespace App\Models;

use App\Casts\LocalizedDateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class RangeWork extends Model
{
  use HasFactory, AsSource, Attachable, Filterable;

  protected $table = 'range_work';

  protected $guarded = [];

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'ins_name',
    'range_serial',
    'range_from',
    'range_to',
    'ins_reg',
    'leader',
    'status'
  ];

  protected static function booted()
  {
    static::created(function ($range) {
      activity('range-create')->performedOn($range)->log('Добавлен новый диапазон для работодателя');
    });

    static::deleted(function ($range) {
      activity('range-deleted')->performedOn($range)->log('Удален диапазон работодателя');
    });
  }

  public static function isInWorkRange($work_num) {
    $regexpWorkRangeNumber = "/^([A-Za-z]+)([[:digit:]]+)$/";
    $matches = [];
    if (preg_match($regexpWorkRangeNumber,$work_num,$matches)) {

      $serial = $matches[1];
      $number = $matches[2];

      $ranges = static::all();

      foreach ($ranges as $range) {
        if ($number >= $range->range_from && $number <= $range->range_to && $serial == $range->range_serial) {
          return true;
        }
      }
    }
    return false;
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
    'range_serial',
    'range_from',
    'range_to',
    'ins_reg',
    'leader',
    'status',
    'created_at',
    'updated_at'
  ];

  public function insurance() {
    return $this->belongsTo(AllowedWork::class, 'ins_reg', 'ins_reg');
  }
}
