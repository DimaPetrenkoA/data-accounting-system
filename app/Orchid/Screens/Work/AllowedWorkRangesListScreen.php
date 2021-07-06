<?php

namespace App\Orchid\Screens\Work;

use App\Models\RangeWork;
use App\Orchid\Layouts\Work\AllowedWorkRangesListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class AllowedWorkRangesListScreen extends Screen
{
  /**
   * Display header name.
   *
   * @var string
   */
   public $name = 'Работодатели';

   public $description = 'Представлен перечень работодателей, которые будут предоставлять работу';

   public $permission = 'allowedWork.view';
  /**
   * Query data.
   *
   * @return array
   */
   public function query(): array
   {
       return [
           'rangeWork' => RangeWork::filters()->defaultSort('id')->paginate(),
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
          Link::make('Добавить работодателя')
              ->icon('plus')
              ->route('allowedWork.addRange')
              ->canSee(Auth::user()->hasAccess('allowedWork.createOrUpdate')),
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
          AllowedWorkRangesListLayout::class,
      ];
    }

    public function remove(RangeWork $rangeWork) {
        $rangeWork->delete();
    }
}
