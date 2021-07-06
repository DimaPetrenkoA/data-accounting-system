<?php

namespace App\Orchid\Screens;

use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Contracts\Cardable;
use Orchid\Screen\Layouts\Card;
use Orchid\Screen\Layouts\Compendium;
use Orchid\Screen\Layouts\Facepile;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Map;


class MainScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Главная';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Информационная система учета данных Центра Занятости';

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
             'card' => new class implements Cardable {
                 /**
                  * @return string
                  */
                 public function title(): string
                 {
                     return 'Цель, задача и механизм проектирования';
                 }

                 /**
                  * @return string
                  */
                 public function description(): string
                 {
                     return 'Создание приложений в стиле администрирования на фреймворке Laravel.
                     Который абстрагирует общие шаблоны бизнес-приложений, так
                     же реализован элегантный интерфейс.
                     Создана админ-панель и система управления контентом.
                     Демонстрация полученных навыков разработки,
                     а так же создание системы учета данных. Приобретение
                     профессиональных навыков практического применения
                     знаний, полученных в процессе обучения.
                     </br>Классическое веб-приложение представляет собой подсистему с общей
                     трёхъярусной архитектурой, которая включает в себя:
                     </br><b>Презентационный уровень</b> - графический интерфейс, представленный
                     пользователю (браузеру), включая javascript сценарии, стили и ресурсы.
                     </br><b>Уровень прикладной логики</b> - в нашем случае это фреймворк - связующее
                     звено, где сосредоточена большая часть бизнес-логики, работа с базой
                     данных (Eloquent), отправка ресурсов и различная обработка.
                     </br><b>Уровень управления ресурсами</b> - обеспечивает хранение данных, как
                     правило, реализуется средствами систем управления базами данных
                     (MySQL,PostgreSQL,Microsoft SQL Server,SQLite). </br>Сокращение времени
                     разработки непосредственно связано с распределением обязанностей
                     между каждым из уровней. Это особенно заметно, когда необходимо
                     создавать вспомогательный код, в то время как, большую часть
                     действительно полезной работы берёт на себя прикладной слой.
                     ';
                 }

                 /**
                  * @return string
                  */
                 public function image(): ?string
                 {
                     return 'https://www.mos.ru/upload/newsfeed/newsfeed/-9u7l9JE.jpeg';
                     //https://picsum.photos/600/300
                 }

                 /**
                  * @return mixed
                  */
                 public function color(): ?Color
                 {
                     return Color::INFO();
                 }

                 /**
                  * {@inheritdoc}
                  */
                 public function status(): ?Color
                 {
                     return Color::INFO();
                 }
             },
             'cardCompendium' => new class implements Cardable {
                 /**
                  * @return string
                  */
                 public function title(): string
                 {
                     return 'Для разработки использовалось';
                 }

                 /**
                  * @return string
                  */
                 public function description(): string
                 {
                     return new Compendium([
                         'PHP'                               => 'v 7.3.24',
                         'JavaScript'                        => 'v 16.3.0',
                         'Composer'                          => 'v 1.10.17',
                         'Apache'                            => 'v 2.4',
                         'MySQL'                             => 'v 5.7',
                         'Open Server'                       => 'v 5.3.8',
                         'GitHub'                            => 'v 2.8.1',
                         'CSS, HTML5'                        => 'и др.',
                     ]);
                 }

                 /**
                  * @return string
                  */
                 public function image(): ?string
                 {
                     return null;
                 }

                 /**
                  * @return mixed
                  */
                 public function color(): ?Color
                 {
                     return Color::SUCCESS();
                 }

                 /**
                  * {@inheritdoc}
                  */
                 public function status(): ?Color
                 {
                     return Color::INFO();
                 }
             },
             'cardPersona'    => new class implements Cardable {
                 /**
                  * @return string
                  */
                 public function title(): string
                 {
                     return 'О проекте';
                 }

                 /**
                  * @return string
                  */
                 public function description(): string
                 {
                     return
                         '<p>
                         Главная цель работы центров занятости – оказание трудового
                         посредничества гражданам и работодателям,
                         реализация активных мер содействия занятости,
                         организация социальной защиты от безработицы.
                         Центры занятости предоставляют услуги населению и работодателям.
                         Все услуги предоставляются бесплатно.
                         В центрах занятости работает специально подготовленный персонал.
                         Многоканальный порядок регистрации вакансий от работодателей.
                         Доступ к самой крупной базе резюме. Адресный подход к
                         каждому клиенту. Доступ к самой крупной базе вакансий.
                         Подбор вариантов вакансий. Содействие гражданам в поиске
                         подходящей работы. Предоставление технических ресурсов
                         для самостоятельного поиска работы – доступ к Электронной
                         бирже труда в зонах самообслуживания в центре занятости.
                         </p>

                         <p> Полученные знания и навыки являются основой для
                         принятия профессиональных решений при проектировании
                         веб-сервиса.
                         </br><li>Система состоит из простого и интуитивно понятного интерфейса с описанием.</li>
                         </br><li>Надёжная система защиты.</li>
                         </br><li>Все услуги предоставляются бесплатно.</li>
                         </br><b>Ниже вы можете видеть всех зарегистрированных
                         пользователей системы.</b></p>'.
                         new Facepile(User::limit(4)->get()->map->presenter());
                 }

                 /**
                  * @return string
                  */
                 public function image(): ?string
                 {
                     return null;
                 }

                 /**
                  * @return mixed
                  */
                 public function color(): ?Color
                 {
                     return Color::DANGER();
                 }

                 /**
                  * {@inheritdoc}
                  */
                 public function status(): ?Color
                 {
                     return Color::INFO();
                 }
             },
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
      * @return array
      */
     public function layout(): array
     {
         return [

             new Card('card', [
                 // Button::make('Редактировать')
                 //     ->method('showToast')
                 //     ->icon('pencil'),
                 // Button::make('Удалить')
                 //     ->method('showToast')
                 //     ->icon('trash'),
             ]),

             Layout::columns([
                 new Card('cardPersona', [
                     // Button::make('Редактировать')
                     //     ->method('showToast')
                     //     ->icon('pencil'),
                     //
                     // Button::make('Удалить')
                     //     ->method('showToast')
                     //     ->icon('trash'),
                 ]),
             ]),

              new Card('cardCompendium'),

              Layout::rows([
                  Map::make('place')
                      ->title('Вы видите нас на карте. Воспользуйтесь поиском объекта и найдите себя.')
                      ->help('Введите координаты или воспользуйтесь поиском'),

              ]),
         ];
     }

     /**
      * @param Request $request
      */
     // public function showToast(Request $request)
     // {
     //     Toast::warning($request->get('toast', 'Приносим свои извинения! Функция временно недоступна.'));
     // }
 }
