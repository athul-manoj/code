<?php

namespace App\Http\Controllers\API;

use App\Events\StatusChanged;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Workflows;

class LeadController extends Controller
{
    public function updateLeadStatus($lead_id, $workflow_id)
    {
        // Validate that the workflow and lead exist
        $workflow = Workflows::findOrFail($workflow_id);
        $lead = Lead::findOrFail($lead_id);

        // Dispatch event to update lead status
        event(new StatusChanged($lead, $workflow));

        return response()->json([
            'message' => 'Lead status update request triggered',
            'lead_id' => $lead_id,
            'workflow_id' => $workflow_id
        ], 200);
    } 
}
