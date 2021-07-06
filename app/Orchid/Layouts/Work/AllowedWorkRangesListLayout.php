<?php

namespace App\Orchid\Layouts\Work;

use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AllowedWorkRangesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'rangeWork';

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
            ->render(function ($allowedWork) {
              return Link::make($allowedWork->ins_name)
              ->route('allowedWork.addRange', $allowedWork);
            }),
            TD::make('ins_reg','Регистрационный номер записи работодателя')
            ->sort(),
            TD::make('number_from','Номер от')
                ->sort()
                ->render(function ($rangeWork) {
                    return sprintf("%s%'.08d",$rangeWork->range_serial,$rangeWork->range_from);
                }),
            TD::make('number_to','Номер до')
                ->sort()
                ->render(function ($rangeWork) {
                    return sprintf("%s%'.08d",$rangeWork->range_serial,$rangeWork->range_to);
                }),
           TD::make('leader','ФИО руководителя')
           ->sort(),

           TD::make('action','Действия')
           ->align(TD::ALIGN_CENTER)
           ->width('100px')
           ->render(function ($rangeWork) {
              return DropDown::make()
              ->icon('options-vertical')
              ->list([

               Link::make('Редактировать')
               ->route('allowedWork.addRange',$work_range->id)
               ->canSee(Auth::user()->hasAccess('allowedWork.createOrUpdate'))
               ->icon('pencil'),

               Button::make('Удалить')
               ->method('remove')
               ->icon('trash')
               ->confirm('Вы действительно хотите удалить данный диапазон?')
               ->parameters([
                'id' => $rangeWork->id,
                  ]),
               ]);
             }),
        ];
    }
}
