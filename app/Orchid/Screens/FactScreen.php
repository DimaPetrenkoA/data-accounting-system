<?php

namespace App\Orchid\Screens;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;




class FactScreen extends Screen
{
  /**
   * Fish text for the table.
   */
  public const TEXT_EXAMPLE = 'Видеорезюме – это возможность привлечь внимание
  потенциального работодателя. По сути, оно представляет собой небольшую
  презентацию конкретного человека, идеально подходящего для должности.';
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Факты для населения';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Ознакомьтесь с фактами или создайте свой';

    public $permission = 'fact.view';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'table'   => [
                new Repository(['id' => 1, 'name' => self::TEXT_EXAMPLE, 'price' => 10000 , 'created_at' => '01.01.2021']),
                new Repository(['id' => 2, 'name' => self::TEXT_EXAMPLE, 'price' => 17000 , 'created_at' => '02.04.2021']),
                new Repository(['id' => 3, 'name' => self::TEXT_EXAMPLE, 'price' => 23000 , 'created_at' => '17.05.2021']),
                new Repository(['id' => 4, 'name' => self::TEXT_EXAMPLE, 'price' => 49000 , 'created_at' => '25.09.2021']),
                new Repository(['id' => 5, 'name' => self::TEXT_EXAMPLE, 'price' => 54000 , 'created_at' => '06.10.2021']),
                new Repository(['id' => 6, 'name' => self::TEXT_EXAMPLE, 'price' => 63000 , 'created_at' => '09.10.2021']),
                new Repository(['id' => 7, 'name' => self::TEXT_EXAMPLE, 'price' => 71000 , 'created_at' => '12.11.2021']),
                new Repository(['id' => 8, 'name' => self::TEXT_EXAMPLE, 'price' => 77000 , 'created_at' => '17.11.2021']),
            ],
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [

            Button::make('Интересный факт')
                ->method('showToast2')
                ->novalidate()
                ->icon('bulb'),

            ModalToggle::make('Создать свой факт')
                ->modal('exampleModal')
                ->method('showToast')
                ->icon('full-screen'),

            DropDown::make('Поиск работы')
                ->icon('folder-alt')
                ->list([

                    Button::make('Постоянная работа')
                        ->method('showToast')
                        ->icon('check'),

                    Button::make('Временная работа')
                        ->method('showToast')
                        ->icon('clock'),
                ]),

        ];
    }

    /**
     * Views.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [

            Layout::table('table', [
                TD::make('id', 'Номер')
                    ->width('150')
                    ->render(function (Repository $model) {
                        return "<img src='https://picsum.photos/450/200?random={$model->get('id')}'
                              alt='sample'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$model->get('id')}</span>";
                    }),

                TD::make('name', 'Информация')
                    ->width('450')
                    ->render(function (Repository $model) {
                        return Str::limit($model->get('name'), 200);
                    }),

                TD::make('price', 'Оплата труда')
                    ->render(function (Repository $model) {
                        return '$ '.number_format($model->get('price'), 2);
                    }),

                TD::make('created_at', 'Дата публикации'),
            ]),

            Layout::modal('exampleModal', Layout::rows([
                Input::make('toast')
                    ->title('Факт')
                    ->placeholder('Введите любой факт')
                    ->help('Введенное факт будет отображаться справа вверху.')
                    ->required(),
            ]))->title('Попробуйте создать свой интересный факт!'),
        ];
    }

    /**
     * @param Request $request
     */
    public function showToast(Request $request)
    {
        Toast::error($request->get('toast', 'К сожалению, на данный момент нет
        свободных вакансий, попробуйте чуть позже.'));
    }

    /**
     * @param Request $request
     */
    public function showToast2(Request $request)
    {
      Toast::info($request->get('toast', 'В офисе Google нет определенного
      графика работы. Каждый сотрудник начинает работать, когда он захочет и
      заканчивает также, когда захочет.'));
    }
}
