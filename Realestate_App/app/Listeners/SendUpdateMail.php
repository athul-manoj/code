<?php

namespace App\Listeners;

use App\Events\StatusChanged;
use App\Jobs\SendStatusUpdateMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUpdateMail
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
    public function handle(StatusChanged $event): void
    {
        $Lead=$event->lead;
        $Workflow=$event->workflow;
        SendStatusUpdateMail::dispatch($Lead,$Workflow);

    }
}
