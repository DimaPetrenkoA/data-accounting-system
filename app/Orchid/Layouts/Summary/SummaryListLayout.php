<?php

namespace App\Orchid\Layouts\Summary;

use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SummaryListLayout extends Table
{
  /**
  * Data source.
  *
  * The name of the key to fetch it from the query.
  * The results of which will be elements of the table.
  *
  * @var string
  */
  protected $target = 'questionnaire';

  /**
  * Get the table cells to be displayed.
  *
  * @return TD[]
  */
  protected function columns(): array
  {
    return [
      TD::make('fio','ФИО')
      ->sort()
      ->filter(TD::FILTER_TEXT)
      ->render(function ($summary) {
        return Link::make($summary->fio)
        ->route('summary.edit', $summary);
      }),
      TD::make('age','Дата рождения')
      ->sort(),
      TD::make('gender','Пол')
      ->sort(),
      TD::make('email','Электронная почта')
      ->sort(),
      TD::make('phone','Мобильный телефон')
      ->sort(),
      TD::make('actual_address','Фактический адрес проживания')
      ->sort(),
      TD::make('citizenship','Гражданство')
      ->sort(),
      TD::make('position','Должность')
      ->sort(),
      TD::make('currency','Уровень дохода')
      ->sort(),
      TD::make('start_work','Начало работы')
      ->sort(),
      TD::make('now_work','По настоящее время')
      ->sort(),
      TD::make('ins_name','Название компании')
      ->sort(),
      TD::make('company_position','Должность')
      ->sort(),
      TD::make('company_about','Обязанности и достижения')
      ->sort(),
      TD::make('education_lvl','Уровень образования')
      ->sort(),
      TD::make('language','Родной язык')
      ->sort(),
      TD::make('about_me','О себе')
            ->sort(),
      TD::make('created_at', 'Создан')
      ->sort(),
      TD::make('updated_at', 'Последнее редактирование')
      ->sort(),

      TD::make('action','Действия')
      ->align(TD::ALIGN_CENTER)
      ->width('100px')
      ->render(function ($questionnaire) {
        return DropDown::make()
        ->icon('options-vertical')
        ->list([

          Link::make('Редактировать')
          ->route('summary.edit',$questionnaire->id)
          ->canSee(Auth::user()->hasAccess('summary.createOrUpdate'))
          ->icon('pencil'),

          Button::make('Удалить')
          ->method('remove')
          ->icon('trash')
          ->confirm('Вы действительно хотите удалить работу?')
          ->parameters([
            'id' => $questionnaire->id,
          ]),
        ]);
      }),
    ];
  }
}
