<?php
namespace App\Orchid\Screens;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class EmailSenderScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Электронная почта';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Страничка, которая позволяет отправить сообщения по электронной почты.';

    public $permission = 'platform.email.view';

    /**
     * Query data.
     *
     * @return array
     */
     public function query(): array
     {
         return [
             'subject' => date("d/m/Y H:i:s").' - Дата и время',
         ];
     }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Отправить сообщение')
                ->icon('paper-plane')
                ->method('sendMessage')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('subject')
                    ->title('Тема')
                    ->required()
                    ->placeholder('Строка темы сообщения')
                    ->help('Введите тему вашего сообщения'),

                Relation::make('users')
                    ->title('Получатели')
                    ->multiple()
                    ->required()
                    ->placeholder('Адрес эл. почты')
                    ->help('Введите пользователей, которым вы хотите отправить это сообщение. Пользователь должен быть зарегистрирован.')
                    //->fromModel(User::class, 'name'),
                    ->fromModel(User::class,'name','email'),

                Quill::make('content')
                    ->title('Содержание')
                    ->required()
                    ->placeholder('Вставить текст здесь ...')
                    ->help('Добавьте содержание сообщения, которое вы хотите отправить.')

            ])
        ];
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'subject' => 'required|min:6|max:50',
            'users'   => 'required',
            'content' => 'required|min:10'
        ]);

        Mail::raw($request->get('content'), function (Message $message) use ($request) {

            $message->subject($request->get('subject'));

            foreach ($request->get('users') as $email) {
                $message->to($email);
            }
        });


        Alert::info('Ваше электронное сообщение было успешно отправлено.');
    }
}
