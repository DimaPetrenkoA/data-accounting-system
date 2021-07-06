<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class UserLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $request;

    public function __construct(Request $request)
    {
        //
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        $ip = $this->request->ip();
        activity('user-login')->log("Пользователь \"$user->name\" (ID: $user->id) успешно авторизовался. IP: $ip");
    }
}
