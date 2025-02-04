<?php

namespace App\Listeners;

use App\Events\StatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log; 


class UpdateLeadStatus
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
        // Assign status from workflow to lead
        $event->lead->status = $event->workflow->status;
        $event->lead->save();
        
        // Log for debugging
        Log::info('Lead status updated via event', [
            'lead_id' => $event->lead->id,
            'new_status' => $event->lead->status,
        ]);
    }
}
