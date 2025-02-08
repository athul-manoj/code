<?php

namespace App\Jobs;

use App\Mail\UpdateNotificationMail;
use App\Models\MessageTemplate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendStatusUpdateMail implements ShouldQueue
{
    use Dispatchable,InteractsWithQueue, Queueable,SerializesModels;
    public $Lead,$Workflow,$template;
    /**
     * Create a new job instance.
     */
    public function __construct($Lead,$Workflow)
    {
        $this->Lead=$Lead;
        $this->Workflow=$Workflow;
        $this->template=MessageTemplate::where('workflow_id',$this->Workflow->id,)->first();

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mail=new UpdateNotificationMail($this->Lead,$this->template);
        Mail::to('Admin@123.com')->send($mail);
    }
}
