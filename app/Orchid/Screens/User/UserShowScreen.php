<?php

namespace App\Orchid\Screens\User;


use App\Orchid\Layouts\User\UserShowLayout;
use Orchid\Platform\Models\Role;
use Orchid\Platform\Models\User;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class UserShowScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Информация о пользователе';

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    public $permission = 'platform.systems.users';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(User $user): array
    {
        $this->user = $user;

        $user->load(['roles']);

        return [
            'user'       => $user,
            'permission' => $user->getStatusPermission(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Label::make('user.id')
                    ->title('ID:'),
                Label::make('user.name')
                    ->title('Имя:'),
                Label::make('user.email')
                    ->title('E-mail:'),
                Label::make('user.created_at')
                    ->title('Создан:'),
                Label::make('user.updated_at')
                    ->title('Отредактирован:'),
                Select::make('user.roles.')
                    ->fromModel(Role::class, 'name')
                    ->multiple()
                    ->title('Роли')
                    ->disabled(),
            ]),
        ];
    }
}
