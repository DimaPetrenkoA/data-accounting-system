<?php

namespace App\Orchid\Layouts\Work;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Quill;

class WorkEditLayout extends Rows
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

            Input::make('allowedWork.ins_name')
                ->required()
                ->placeholder('Наименование работодателя')
                ->type('text')
                ->max(255)
                ->title('Полное наименование работодателя')
                ->help('Введите полное наименование работодателя')
                ->popover('Поле "Полное наменование" работодателя будет тянутся
                в талицу "Работодатели", в которой будет закреплен
                регистрационный номер записи'),

            Input::make('allowedWork.ins_reg')
                ->required()
                ->type('number')
                ->placeholder('Рег. номер работодателя')
                ->title('Регистрационный номер записи работодателя')
                ->help('Введите регистрационный номер работодателя'),

            Input::make('allowedWork.email')
                ->required()
                ->title('Электронная почта')
                ->placeholder(' name@yandex.ru , name@mail.ru , name@google.com , name@icloud.com и тд')
                ->help("Введите электронную почту")
                ->popover('Эллектронная почта нужна для связи с кандидатами.'),

            Input::make('allowedWork.phone')
                ->type('text')
                ->placeholder('071*******')
                ->max(10)
                ->title('Мобильный телефон')
                ->help('Введите номер телефона из 10 цифр')
                ->mask('(999) 999-9999'),

            Input::make('allowedWork.actual_address')
                ->type('text')
                ->placeholder('Адрес регистрации')
                ->max(255)
                ->title('Адрес')
                ->help('Укажите адрес регистрации'),

            Input::make('allowedWork.currency')
                ->required()
                ->title('Уровень дохода')
                ->mask([
                    'alias' => 'currency',
                ])->help('Укажите уровень дохода в формате 0руб. 00коп.'),

            TextArea::make('allowedWork.company_position')
                ->required()
                ->type('text')
                ->placeholder('Введите должность')
                ->max(255)
                ->title('Должность'),

            Quill::make('allowedWork.company_about')
                 ->required()
                 ->type('text')
                 ->max(255)
                 ->title('Обязанности и пожелания')
                 ->placeholder('Вставить текст здесь ...')
                 ->help('Кратко расскажите об обязанностях и пожеланиях'),

            CheckBox::make('allowedWork.status')
                ->required()
                ->sendTrueOrFalse()
                ->title('Статус документа')
                ->placeholder('Я ознакомился с условиями регистрирования
                рабочего места и даю согласие на обработу
                персональных данных.')
                ->help('Поставьте галочку, если согласны с условиями и готовы
                зарегестрировать работу.'),
        ];
    }
}
