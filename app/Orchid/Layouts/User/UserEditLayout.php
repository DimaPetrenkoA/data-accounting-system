<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title("ФИО пользователя")
                ->placeholder("ФИО пользователя"),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title("E-mail")
                ->placeholder("E-mail"),
        ];
    }
}
