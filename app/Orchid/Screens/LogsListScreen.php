<?php

namespace App\Orchid\Screens;

use App\Models\Log;
use App\Orchid\Layouts\LogsListLayout;
use Orchid\Screen\Screen;
use Spatie\Activitylog\Models\Activity;

class LogsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Лог действий пользователей';

    public $permission = 'logs.view';
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'log' => Log::with('causer')
                ->filters()
                ->defaultSort('id','desc')
                ->paginate(20)
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
            LogsListLayout::class
        ];
    }
}
