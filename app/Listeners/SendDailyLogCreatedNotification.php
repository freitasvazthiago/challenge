<?php

namespace App\Listeners;

use App\Events\DailyLogCreated;
use App\Mail\DailyLogCopy;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class SendDailyLogCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DailyLogCreated  $event
     * @return void
     */
    public function handle(DailyLogCreated $event)
    {
        \Mail::to($event->user->email)->send(
            new DailyLogCopy($event->user)
        );
    }
}
