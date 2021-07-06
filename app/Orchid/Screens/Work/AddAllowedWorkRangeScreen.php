<?php

namespace App\Orchid\Screens\Work;

use App\Models\RangeWork;
use App\Orchid\Layouts\Work\AddAllowedWorkRangeLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class AddAllowedWorkRangeScreen extends Screen
{
  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Добавление работодателя';

  public $permission = 'allowedWork.createOrUpdate';

  public $description = 'Добавить работодателя указав диапазон уникальных номеров';

  public $exists = false;

  /**
   * Query data.
   *
   * @return array
   */
   public function query(RangeWork $rangeWork): array
   {
       $this->exists = $rangeWork->exists;

       if ($this->exists) {
           $this->name = 'Редактирование диапазона';
       }

       return [
           'rangeWork' => $rangeWork
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
           Button::make('Добавить работодателя')
               ->icon('pencil')
               ->method('createOrUpdate')
               ->canSee(!$this->exists),

           Button::make('Сохранить изменения')
               ->icon('note')
               ->method('createOrUpdate')
               ->canSee($this->exists),
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
          AddAllowedWorkRangeLayout::class,
      ];
  }

  public function createOrUpdate(RangeWork $rangeWork, Request $request) {

      $request->validate([
          'rangeWork.serial' => 'required',
          'rangeWork.num_from' => 'required|integer|lte:num_to',
          'rangeWork.num_to' => 'required|integer|gte:num_from',
          'rangeWork.ins_reg' => 'required'                    // |exists:allowedWork,ins_reg'
      ], [
          'rangeWork.serial.required' => 'Поле серии обязательно для заполнения',
          'rangeWork.num_from.required' => 'Поле начала диапазона обязательно для заполнения',
          'rangeWork.num_from.integer' => 'Поле начала диапазона должно быть числом',
          'rangeWork.num_from.lte' => 'Поле начала диапазона должно быть меньше или равно концу диапазона',
          'rangeWork.num_to.integer' => 'Поле конца диапазона должно быть числом',
          'rangeWork.num_to.required' => 'Поле конца диапазона обязательно для заполнения',
          'rangeWork.num_to.gte' => 'Поле конца диапазона должно быть больше или равно началу диапазона',
          'rangeWork.ins_reg.required' => 'Необходимо обязательно выбрать работодателя'
      ]);

      $range_serial = $request->input('serial');
      $range_from = $request->input('num_from');
      $range_to = $request->input('num_to');
      $ins_reg = $request->input('ins_reg');

      $busy_work_ranges = RangeWork::where('range_serial',$range_serial)->get();

      $isIntersect = false;

      foreach ($busy_work_ranges  as $rangeWork) {
          if ( ($range_from < $range->range_from && $range_to < $rangeWork->range_from) || ($range_from > $rangeWork->range_to && $range_to > $rangeWork->range_to) ) {
              // так было проще городить читаемое условие с пустым тело по ветке true
          } else {
              $isIntersect = true;
          }
      }

      if ($isIntersect) {
          return redirect()->back()->withInput()->withErrors(['form' => ['Данный диапазон пересекается с существующим']]);
      }

      RangeWork::create([
          'range_serial' => $range_serial,
          'range_from' => $range_from,
          'range_to' => $range_to,
          'ins_reg' => $ins_reg,
      ]);

      $rangeWork->fill($request->get('rangeWork'))->save();

      Alert::info('Диапазон успешно добавлен');

      return redirect()->route('allowedWork.ranges');
  }
}
