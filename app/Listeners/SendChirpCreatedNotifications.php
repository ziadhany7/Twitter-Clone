<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChirpCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChirpCreated $event): void
    {
        // Use chunking for better performance with large datasets
        User::where('id', '!=', $event->chirp->user_id)
            ->chunk(100, function ($users) use ($event) {
                foreach ($users as $user) {
                    $user->notify(new NewChirp($event->chirp));
                }
            });
    }
}

