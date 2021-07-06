<?php

namespace App\Orchid\Screens\Summary;

use App\Models\Questionnaire;
use App\Orchid\Layouts\Summary\SummaryListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class SummaryListScreen extends Screen
{
  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Перечень анкет';

  /**
   * Display header description.
   *
   * @var string|null
   */
  public $description = 'Подайте анкету заполнив необходимые поля и шанс трудоустройства увеличится.';

  public $permission = 'summary.view';

  /**
   * Query data.
   *
   * @return array
   */
  public function query(): array
  {
      return [
          'questionnaire' => Questionnaire::filters()->defaultSort('id')->paginate(),
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
          Link::make('Добавить анкету')
              ->icon('plus')
              ->route('summary.edit')
              ->canSee(Auth::user()->hasAccess('summary.createOrUpdate')),
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
          SummaryListLayout::class,
      ];
  }

  public function remove(Questionnaire $questionnaire) {
      $questionnaire->delete();
  }
}
