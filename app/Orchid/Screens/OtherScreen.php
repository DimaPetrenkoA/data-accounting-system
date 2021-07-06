<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Str;
use Orchid\Screen\Action;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\SimpleMDE;


class OtherScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Текстовые редакторы';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Пример использования текстовых редакторов SimpleMDE, Quill и кода.';

    public $permission = 'editor.view';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'name'  => 'Привет! ты видишь ДонНТУ на карте',
            'place' => [
                'lat' => 47.994313500000004,
                'lng' => 37.80318884812909,
            ],
            'quill'     => 'Текст',
            'simplemde' => '# Заголовок',
            'code'      => Str::limit(file_get_contents(__FILE__), 500),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @throws \Throwable
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [

            Layout::rows([

              SimpleMDE::make('simplemde')
                  ->title('Редактор SimpleMDE')
                  ->popover('SimpleMDE - простой, встраиваемый и красивый редактор разметки JS.'),

              Quill::make('quill')
                  ->title('Редактор Quill')
                  ->popover('Quill - это бесплатный редактор с открытым исходным кодом, созданный для современного Интернета.'),

              Code::make('code')
                  ->title('Код'),
            ]),
        ];
    }
}
