<?php

namespace App\Listeners;

use App\Events\ArticleProcessed;
use App\Jobs\ArticleNotificationJob;

class ArtileNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param ArticleProcessed $event
     * @return void
     */
    public function handle(ArticleProcessed $event): void
    {
        ArticleNotificationJob::dispatch(auth()->user())->onQueue('emails');
    }
}
