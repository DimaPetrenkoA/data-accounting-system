<?php

namespace App\Orchid\Layouts\Work;

use App\Models\AllowedWork;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class AddAllowedWorkRangeLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [

            Input::make('rangeWork.serial')
                ->type('text')
                ->max(10)
                ->required()
                ->title('Серия')
                ->help('Введите заглавные английские буквы')
                ->mask([
                    'regex' => '[A-Z]+'
                ])
                ->placeholder('SERIES')
                ->popover('Введите английские буквы в верхнем регистре'),

            Input::make('rangeWork.num_from')
                ->placeholder('Введите начальный номер с которого начнется нумерация')
                ->type('number')
                ->required()
                ->title('Номер от')
                ->help('Введите номер с которого будет идти нумерация'),

            Input::make('rangeWork.num_to')
                ->placeholder('Введите конечный номер с которого закончится нумерация')
                ->type('number')
                ->required()
                ->title('Номер до')
                ->help('Введите номер до которого будет идти нумерация'),

            Select::make('rangeWork.ins_reg')
                ->popover('Выберите работодателя, в базе "Перечень работ" к нему должна относится как минимум 1 работа.')
                ->fromModel(AllowedWork::class, 'ins_name', 'ins_reg')
                ->required()
                ->title('Работодатель'),

           TextArea::make('rangeWork.leader')
               ->required()
               ->type('text')
               ->placeholder('Укажите ответственное лицо')
               ->max(255)
               ->title('ФИО руководителя'),
        ];
    }
}
