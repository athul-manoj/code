<?php

namespace App\Http\Controllers\Api;
use App\Models\Phase;
use App\Http\Controllers\Controller;
use App\Http\Resources\PhaseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PhaseController extends Controller
{
    public function index()
    {
        $pageSize = 10;
        $pageNumber = 1;
        $offset = ($pageNumber - 1) * $pageSize;

        $query = Phase::query();
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
            'filteredCount' => Phase::count(),
            'total' => $filteredUsersCount,
        ], 200);
        
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'message' => 'All Fields are Mandatory',
                'error' => $validator->messages(),
            ],422);
        }
        
        $phase = Phase::create([
            'name' => $request->name,
            'status' => $request->status,
           
                
            ]);
           // event(new StudentEntryMadeSuccessfully($student));
            return response()->json([
                'message' => 'Entry made successfully',
                'data' => new PhaseResource($phase)
            ],200);
    }

    public function show(Phase $id)
    {
      if($id->count()>0){
        return new PhaseResource($id);
        }
    else{
            return response()->json(['message' => 'No Records Found :('],200);
        }
    }

    public function update(Request $request,Phase $id)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
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
                
        ]);
        

         return response()->json([
            'message' => 'phase info updated successfully',
            'data' => new PhaseResource($id),
         ],200);
    }

    public function destroy(Phase $id)
    {
       if($id->delete()){ 
       return response()->json([
        'message' => 'phase deleted successfully',
     ],200);
    }
    }

  
}
