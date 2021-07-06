<?php

namespace App\Orchid\Screens\Work;

use App\Models\AllowedWork;
use App\Orchid\Layouts\Work\WorkListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class WorkListScreen extends Screen
{
  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Работа';

  public $description = 'Представлен список работ с полной занятостью,
  частичной занятостью, проектной работой, волонтерством, стажировкой.';

  public $permission = 'work.view';

  /**
   * Query data.
   *
   * @return array
   */
  public function query(): array
  {
      return [
          'allowedWork' => AllowedWork::filters()->defaultSort('id')->paginate(),
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
          Link::make('Добавить работу')
              ->icon('plus')
              ->route('work.edit')
              ->canSee(Auth::user()->hasAccess('work.createOrUpdate')),
       ];
  }

  /**
   * Views.
   *
   * @return \Orchid\Screen\Layout[]|string[]
   */
  public function layout(): array
  {
      return [
          WorkListLayout::class,
      ];
  }

  public function remove(AllowedWork $allowedWork) {
      $allowedWork->delete();
  }
}
