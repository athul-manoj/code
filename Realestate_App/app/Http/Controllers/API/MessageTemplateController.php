<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MessageTemplate;
use Illuminate\Support\Facades\Auth;

class MessageTemplateController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'workflow_id' => 'required|exists:workflows,id',
            'template' => 'required|string',
        ]);

        $messageTemplate = MessageTemplate::create([
            'workflow_id' => $request->workflow_id,
            'template' => $request->template,
            'created_by' => Auth::id(),
        ]);

        return response()->json(['message' => 'Template created successfully', 'data' => $messageTemplate], 201);
    }

    public function update(Request $request, $id)
    {
        $messageTemplate = MessageTemplate::findOrFail($id);
        $messageTemplate->update([
            'template' => $request->template,
            'updated_by' => Auth::id(),
        ]);

        return response()->json(['message' => 'Template updated successfully', 'data' => $messageTemplate], 200);
    }

    public function destroy($id)
    {
        $messageTemplate = MessageTemplate::findOrFail($id);
        $messageTemplate->deleted_by = Auth::id();
        $messageTemplate->save(); // Save before deletion
        $messageTemplate->delete(); // Soft delete

        return response()->json(['message' => 'Template deleted successfully'], 200);
    }
}

