<?php

namespace App\Orchid;

use App\Orchid\Layouts\StatCardLayout;
use App\Orchid\Layouts\StatTableCardLayout;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\LayoutFactory;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        LayoutFactory::macro('statCard', function ($title, array $data) {
            return new StatCardLayout($title, $data);
        });

        LayoutFactory::macro('statTableCard', function ($title, array $data) {
            return new StatTableCardLayout($title, $data);
        });
    }

    /**
     * @return ItemMenu[]
     */
    public function registerMainMenu(): array
    {
        return [
            ItemMenu::label('Главная')
              ->icon('home')
              ->route('platform.main'),

            ItemMenu::label('Анкета')
             ->slug('Summary-menu')
             ->icon('folder-alt')
             ->withChildren()
             ->hideEmpty(),

            ItemMenu::label('Заполнить анкету')
              ->icon('note')
              ->place('Summary-menu')
              ->route('summary.edit')
              ->permission('summary.createOrUpdate'),

            ItemMenu::label('Перечень анкет')
              ->icon('database')
              ->place('Summary-menu')
              ->route('summarys.index')
              ->permission('summary.view'),

            ItemMenu::label('Работа')
                ->slug('Work-menu')
                ->icon('book-open')
                ->withChildren()
                ->hideEmpty(),

            ItemMenu::label('Добавить работу')
                 ->place('Work-menu')
                 ->icon('note')
                 ->route('work.edit')
                 ->permission('work.createOrUpdate'),

            ItemMenu::label('Перечень работ')
                ->place('Work-menu')
                ->icon('database')
                ->route('works.index')
                ->permission('work.view'),

            ItemMenu::label('Добавить работодателя')
                 ->place('Work-menu')
                 ->icon('note')
                 ->route('allowedWork.addRange')
                 ->permission('allowedWork.createOrUpdate'),

             ItemMenu::label('Список работодателей')
                ->place('Work-menu')
                ->icon('database')
                ->route('allowedWork.ranges')
                ->permission('allowedWork.view'),

            ItemMenu::label('Логи')
                ->icon('config')
                ->route('logs.index')
                ->permission('logs.view'),

            ItemMenu::label('Ссылки')
                ->slug('vk-menu')
                ->icon('link')
                ->withChildren()
                ->hideEmpty(),

            ItemMenu::label('Петренко Д. А.')
                ->place('vk-menu')
                ->icon('social-vkontakte')
                ->title('Ссылка на разработчика')
                ->url('https://vk.com/mr.petrenko'),

            ItemMenu::label('ДонНТУ')
                ->place('vk-menu')
                ->icon('building')
                ->title('Ссылка на университет')
                ->url('http://donntu.org/'),

             ItemMenu::label('Факты')
                ->icon('bubble')
                ->route('platform.fact')
                ->permission('fact.view')
                ->badge(function () {
                    return "New";
                }),

             ItemMenu::label('Редактор')
                ->icon('info')
                ->route('other.forms')
                ->permission('editor.view'),

        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            ItemMenu::label('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerSystemMenu(): array
    {
        return [
            ItemMenu::label(__('Access rights'))
                ->icon('lock')
                ->slug('Auth')
                ->active('platform.systems.*')
                ->permission('platform.systems.index')
                ->sort(1000),

            ItemMenu::label(__('Users'))
                ->place('Auth')
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->sort(1000)
                ->title(__('All registered users')),

            ItemMenu::label(__('Roles'))
                ->place('Auth')
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->sort(1000)
                ->title(__('A Role defines a set of tasks a user assigned the role is allowed to perform.')),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group('Системные')
                ->addPermission('platform.systems.roles', 'Управление ролями')
                ->addPermission('platform.systems.users', 'Управление пользователями'),
            ItemPermission::group('Работа')
                ->addPermission('work.createOrUpdate','Добавление и редактирование работы')
                ->addPermission('work.view','Просмотр информации о работе')
                ->addPermission('allowedWork.createOrUpdate','Добавление и редактирование диапазона номеров для работодателя')
                ->addPermission('allowedWork.view','Просмотр диапазонов номеров для работодателей'),
           ItemPermission::group('Анкета')
                 ->addPermission('platform.edit.view','Создание анкет в Базе Данных')
                 ->addPermission('platform.list.view','Просмотр анкет в Базе Данных')
                 ->addPermission('summary.view','Просмотр информации об анкете')
                 ->addPermission('summary.createOrUpdate','Добавление и редактирование анкеты'),
          ItemPermission::group('Логи')
                ->addPermission('logs.view','Просмотре действий пользователей'),
           ItemPermission::group('Факты')
                 ->addPermission('fact.view','Посмотреть факты')
                 ->addPermission('editor.view','Использование текстового редактора')
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
