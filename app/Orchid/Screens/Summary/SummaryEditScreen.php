<?php

namespace App\Orchid\Screens\Summary;

use App\Models\Questionnaire;
use App\Orchid\Layouts\Summary\SummaryEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class SummaryEditScreen extends Screen
{
  /**
   * Display header name.
   *
   * @var string
   */
  public $name = 'Добавление анкету';

  public $permission = 'summary.createOrUpdate';

  public $description = 'Добавление анкеты в базе данных';

  public $exists = false;

  /**
   * Query data.
   *
   * @return array
   */
  public function query(Questionnaire $questionnaire): array
  {
      $this->exists = $questionnaire->exists;

      if ($this->exists) {
          $this->name = 'Редактирование информации в анкете';
      }

      return [
          'questionnaire' => $questionnaire
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
          Button::make('Добавить анкету')
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
          SummaryEditLayout::class,
      ];
  }

  public function createOrUpdate(Questionnaire $questionnaire, Request $request) {

      $request->validate([
          'questionnaire.fio' => 'required',
          'questionnaire.age' => [
              'required',
              // Rule::unique(Questionnaire::class, 'age')->ignore($questionnaire)
          ],
          'questionnaire.gender' => 'required',
          'questionnaire.email' => 'required',
      ],[
          'questionnaire.fio.required' => 'Укажите ФИО, поле обязательно для заполнения',
          'questionnaire.age.required' => 'Укажите дату рождения, поле обязательно для заполнения',
          'questionnaire.gender.required' => 'Укажите пол, поле обязательно для заполнения',
          'questionnaire.email.required' => 'Введите адрес электронной почты, поле обязательно для заполнения',
      ]);

      $questionnaire->fill($request->get('questionnaire'))->save();

      Alert::info('Информация об этой акенте успешно сохранена');

      return redirect()->route('summarys.index');
  }
}
