<?php

namespace App\Http\Controllers;

use App\Models\ProblemStatus;
use App\Models\ProblemStatusModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProblemStatusController extends Controller
{
    public function index()
    {
        $problem_status = ProblemStatus::all();
        return response()->view('cms.problem_status.index', ['problem_status' => $problem_status]);
    }
    public function create()
    {
        return response()->view('cms.problem_status.create');
    }
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name_en' => 'required|string|min:3',
            'name_ar' => 'required|string|min:3',
        ]);
        if (!$validator->fails()) {
            $problem_status = new ProblemStatus();
            $problem_status->name_en = $request->input('name_en');
            $problem_status->name_ar = $request->input('name_ar');
            $isSaved = $problem_status->save();
            return response()->json(
             ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
              $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,);
        }
    }
    public function edit(ProblemStatus $problem_status)
    {
        
        return response()->view('cms.problem_status.edit', ['problem_status' => $problem_status]);
    }
    public function update(Request $request, ProblemStatus $problem_status)
    {
        $validator = Validator($request->all(), [
            'name_en' => 'nullable|string|min:3', 
            'name_ar' => 'nullable|string|min:3',           
        ]);
        if (!$validator->fails()) {
            $problem_status->name_en = $request->input('name_en');
            $problem_status->name_ar = $request->input('name_ar');
            $isSaved = $problem_status->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    
    public function destroy(ProblemStatus $problem_status)
    {
        $deleted = $problem_status->delete(); 
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
    public function ProblemStatusActive($id)
    {
        $problem_status = ProblemStatus::Where('id', '=', $id)->first();

        $problem_status->status = !$problem_status->status;
        $problem_status->save();
        return response()->json(
            ['message' => $problem_status ? 'Change Status successfully' : 'Change Status failed!'],
            $problem_status ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}

