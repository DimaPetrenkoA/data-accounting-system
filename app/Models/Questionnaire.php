<?php

namespace App\Models;

use App\Casts\LocalizedDateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Questionnaire extends Model
{
  use HasFactory, AsSource, Attachable, Filterable;

  protected $table = 'questionnaire';

  protected $guarded = [];
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'id',
    'fio',
    'age',
    'gender',
    'email',
    'phone',
    'actual_address',
    'citizenship',
    'position',
    'currency',
    'start_work',
    'now_work',
    'ins_name',
    'company_position',
    'company_about',
    'education_lvl',
    'language',
    'about_me'
  ];

  protected static function booted()
  {
    static::created(function ($questionnaire) {
      activity('questionnaire-create')->performedOn($questionnaire)->log('Добавлена новая анкета');
    });

    static::deleted(function ($questionnaire) {
      activity('questionnaire-deleted')->performedOn($questionnaire)->log('Удалена анкета');
    });

    static::updated(function ($questionnaire) {
      activity('questionnaire-update')->performedOn($questionnaire)->log('Анкета отредактирована');
    });
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
    'fio'
  ];

  /**
  * Name of columns to which http sorting can be applied
  *
  * @var array
  */
  protected $allowedSorts = [
    'id',
    'fio',
    'age',
    'gender',
    'email',
    'phone',
    'actual_address',
    'citizenship',
    'position',
    'currency',
    'start_work',
    'now_work',
    'ins_name',
    'company_position',
    'company_about',
    'education_lvl',
    'language',
    'about_me',
    'created_at',
    'updated_at'
  ];
}
