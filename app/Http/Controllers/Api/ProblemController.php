<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Problem;
use App\Models\ProblemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('user-api')->check()){
            $id=auth('user-api')->user()->id;
            $problems=Problem::Where('user_id',$id)->withCount('models')->get();
            return response()->json(['status'=>true,'message'=>'Success','problems'=>$problems]);

        }  
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'model_id' => 'required|exists:s_models,id',
            'description'=>'required|string',

        ]);

        if (!$validator->fails()) {
        if(Auth('user-api')->check()){
         
                $problem = new Problem();
                $problem->user_id = auth('user-api')->user()->id;
                $problem->details = $request->input('description');
                $isSaved = $problem->save();
                if( $isSaved){
                    $problemModel = new ProblemModel();
                    $problemModel->problem_id =$problem->id;
                    $problemModel->model_id =$request->input('model_id');
                    $problemModel->user_id = auth('user-api')->user()->id;
                    $isSaved = $problemModel->save();
                }
                return response()->json(['status'=>true,'message'=>'Success','problem-model'=>$problemModel]);
        }

          
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }   
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $problem=Problem::where('id',$id)->first();
        if(Auth::guard('user-api')->check()){
            $user_id=auth('user-api')->user()->id;
            $problem=Problem::where('id',$id)->Where('user_id',$user_id)->first();
            $isDeleted = $problem->delete();
            return response()->json(['message' =>$isDeleted ? 'Deleted successfully':'Deleted Failed'], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }
       
    }
}
