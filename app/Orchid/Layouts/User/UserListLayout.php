<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

//use Orchid\Platform\Models\User;
use App\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'users';

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            TD::make('name', "ФИО пользователя")
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (User $user) {
                    return new Persona($user->presenter());
                }),

            TD::make('email', "E-mail")
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT),

            TD::make('updated_at', 'Последнее редактирование')
                ->sort(),

            TD::make("Действие")
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (User $user) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make("Редактировать")
                                ->route('platform.systems.users.edit', $user->id)
                                ->icon('pencil'),

                            Button::make("Удалить")
                                ->icon('trash')
                                ->method('remove')
                                ->confirm('Вы действительно хотите удалить пользователя?')
                                ->parameters([
                                    'id' => $user->id,
                                ]),
                        ]);
                }),
        ];
    }
}
