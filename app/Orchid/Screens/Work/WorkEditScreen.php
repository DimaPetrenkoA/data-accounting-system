<?php

namespace App\Orchid\Screens\Work;

use App\Models\AllowedWork;
use App\Orchid\Layouts\Work\WorkEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class WorkEditScreen extends Screen
{
  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Добавление работы';

  public $description = 'Чтобы добавить работу, заполните все необходимые поля.';

  public $permission = 'work.createOrUpdate';

  public $exists = false;

  /**
   * Query data.
   *
   * @return array
   */
  public function query(AllowedWork $allowedWork): array
  {
      $this->exists = $allowedWork->exists;

      if ($this->exists) {
          $this->name = 'Редактирование информации о работе';
      }

      return [
          'allowedWork' => $allowedWork
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
          Button::make('Добавить работу')
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
          WorkEditLayout::class,
      ];
  }

  public function createOrUpdate(AllowedWork $allowedWork, Request $request) {

      $request->validate([
          'allowedWork.ins_name' => 'required',
          'allowedWork.ins_reg' => [
              'required',
              'numeric',
              Rule::unique(AllowedWork::class, 'ins_reg')->ignore($allowedWork)
          ],
          'allowedWork.email'  => 'required',
          'allowedWork.currency'  => 'required',
          'allowedWork.company_position'  => 'required',
          'allowedWork.company_about'  => 'required',
          'allowedWork.status'  => 'required',
      ],[
          'allowedWork.ins_name.required' => 'Поле названия работы обязательно для заполнения',
          'allowedWork.ins_reg.required' => 'Поле регистрационного номера записи работодателя обязательно для заполнения',
          'allowedWork.ins_reg.numeric' => 'Поле регистрационного номера записи работодателя должно содержать только цифры',
          'allowedWork.ins_reg.unique' => 'Поле регистрационного номера записи работодателя должно быть уникальным',
          'allowedWork.email.required' => 'Поле электронная почта обязательно для заполнения',
          'allowedWork.currency.required' => 'Поле уровень дохода обязательно для заполнения',
          'allowedWork.company_position.required' => 'Поле должность обязательно для заполнения',
          'allowedWork.company_about.required' => 'Поле обязанности и пожелания обязательно для заполнения',
          'allowedWork.status.required' => 'Поле cтатус документа обязательно для заполнения',
      ]);

      $allowedWork->fill($request->get('allowedWork'))->save();

      Alert::info('Информация о работе успешно сохранена');

      return redirect()->route('works.index');
  }
}
