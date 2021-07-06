<?php

namespace App\Orchid\Layouts;

use App\Models\Log;
use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class LogsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'log';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('created_at','Время')
                ->sort(),
            TD::make('log_name','Уровень')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('causer.name','Инициатор')
                ->sort(),
            TD::make('description','Описание'),
        ];
    }
}
