<?php

namespace App\Listeners;

use App\Events\RegisterUserEvent;
use App\Mail\VerifyRegisterEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerifyEmailRegisterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param RegisterUserEvent $event
     * @return void
     */
    public function handle(RegisterUserEvent $event)
    {
        // step four this listener receive RegisterUserEvent instance like this handle method
        // and send an email
        Mail::to($event->user->email)->send(new VerifyRegisterEmail($event->user,$event->encrypted));
       //  dd('hello listener');
    }
}
