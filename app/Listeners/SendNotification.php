<?php

namespace App\Listeners;

use LaraZeus\Bolt\Events\FormSent;
use Illuminate\Support\Facades\Log;
use LaraZeus\Bolt\Events\FormMounted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaraZeus\Bolt\Models\FieldResponse;
use LaraZeus\Bolt\Models\Form;

class SendNotification
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
    public function handle(FormSent $event): void
    {
        dd(FieldResponse::where('response_id', $event->response->id)->get());
    }
}
