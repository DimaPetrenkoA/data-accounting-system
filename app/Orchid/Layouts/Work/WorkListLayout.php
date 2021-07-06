<?php

namespace App\Orchid\Layouts\Work;

use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class WorkListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'allowedWork';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('ins_name','Полное наименование работодателя')
            ->sort()
            ->filter(TD::FILTER_TEXT)
            ->render(function ($work) {
              return Link::make($work->ins_name)
               ->route('works.index', $work);
             }),
            TD::make('ins_reg','Регистрационный номер записи работодателя')
            ->sort(),
            TD::make('email','Электронная почта')
            ->sort(),
            TD::make('phone','Мобильный телефон')
            ->sort(),
            TD::make('actual_address','Адрес регистрации')
            ->sort(),
            TD::make('currency','Уровень дохода')
            ->sort(),
            TD::make('company_position','Должность')
            ->sort(),
            TD::make('company_about','Обязанности и пожелания')
            ->sort(),
            TD::make('status','Статус документа')
            ->sort(),
            TD::make('created_at', 'Создан')
            ->sort(),
            TD::make('updated_at', 'Последнее редактирование')
            ->sort(),

            TD::make('Действие')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function ($allowedWork) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make('Редактировать')
                                ->route('work.edit',$allowedWork->id)
                                ->canSee(Auth::user()->hasAccess('work.createOrUpdate'))
                                ->icon('pencil'),

                           Button::make('Удалить')
                               ->method('remove')
                               ->icon('trash')
                               ->confirm('Вы действительно хотите удалить работу?')
                               ->parameters([
                                   'id' => $allowedWork->id,
                               ]),
                        ]);
                }),
        ];
    }
}
