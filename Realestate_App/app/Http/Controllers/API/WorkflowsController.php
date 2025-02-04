<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkflowsResource;
use App\Models\Workflows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WorkflowsController extends Controller
{
    public function index()
    {
        $pageSize = 10;
        $pageNumber = 1;
        $offset = ($pageNumber - 1) * $pageSize;

        $query = Workflows::query();
        $filteredUsersCount = $query->count();
        $query = $query->take($pageSize)->skip($offset);

        $usersData = $query->get()->map(function ($user) {
            return [
                'name' => $user->name,
                'status' => $user->status,
            ];
        });

        return response()->json([
            'data' => $usersData,
            'filteredCount' => Workflows::count(),
            'total' => $filteredUsersCount,
        ], 200);
        
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'phase_id' => 'required|exists:phase,id',

        ]);
        if($validator->fails())
        {
            return response()->json([
                'message' => 'All Fields are Mandatory',
                'error' => $validator->messages(),
            ],422);
        }
        
        $Workflow = Workflows::create([
            'name' => $request->name,
            'status' => $request->status,
            'phase_id' => $request->phase_id,
           
                
            ]);
           // event(new StudentEntryMadeSuccessfully($student));
            return response()->json([
                'message' => 'Entry made successfully',
                'data' => new WorkflowsResource($Workflow)
            ],200);
    }

    public function show(Workflows $id)
    {
      if($id->count()>0){
        return new WorkflowsResource($id);
        }
    else{
            return response()->json(['message' => 'No Records Found :('],200);
        }
    }

    public function update(Request $request,Workflows $id)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'phase_id' => 'sometimes|exists:phase,id',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'message' => 'All Fields are Mandatory',
                'error' => $validator->messages(),
            ],422);
        }
        
        $id->update([
            'name' => $request->name,
            'status' => $request->status,
            'phase_id' => $request->phase_id,
                
        ]);
        

         return response()->json([
            'message' => 'phase info updated successfully',
            'data' => new WorkflowsResource($id),
         ],200);
    }

    public function destroy(Workflows $id)
    {
       if($id->delete()){ 
       return response()->json([
        'message' => 'phase deleted successfully',
     ],200);
    }
    }

  
}
