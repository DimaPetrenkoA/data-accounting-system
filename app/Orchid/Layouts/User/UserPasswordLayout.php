<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

//use Orchid\Platform\Models\User;
use App\Models\User;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Layouts\Rows;

class UserPasswordLayout extends Rows
{
    /**
     * Views.
     *
     * @return array
     */
    public function fields(): array
    {
        /** @var User $user */
        $user = $this->query->get('user');
        $plaseholder = $user->exists
            ? "Оставьте поле пустым, если не хотите менять пароль"
            : "Введите пароль";

        return [
            Password::make('user.password')
                ->placeholder($plaseholder)
                ->title("Пароль"),
        ];
    }
}
