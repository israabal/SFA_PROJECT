<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\SModel;
use App\Models\User;
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
        $problems=Problem::all();

        return response()->view('cms.problem.index', ['problems'=>$problems]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models=SModel::where('active',1)->get();
        return response()->view('cms.problem.create',['models'=>$models]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
        $validator = Validator($request->all(), [
            'd_log' => 'required|numeric',
            'd_lat' => 'required|numeric',
            'details' => 'required|string',
            'model_id'=>'required|numeric|exists:s_models,id',
        ]);
        if (!$validator->fails()) {
            $problem = new Problem();

        $problem->d_log = $request->input('d_log');
        $problem->d_lat = $request->input('d_lat');
        $problem->model_id = $request->input('model_id');
        $problem->details = $request->input('details');
        $problem->user_id =auth('user')->user()->id;





        $isSaved = $problem ->save();

        return response()->json(
            ['message' => $isSaved ? __('cms.create_success') : __('cms.create_failed')],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
        );
    }
    else {
        return response()->json(
            ['message' => $validator->getMessageBag()->first()],
            Response::HTTP_BAD_REQUEST,
        );



 }
}






        // $isSaved = $request->user()->save($user);



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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $problem = Problem::findOrFail($id);
        $sparePartModels=SModel::where('active',1)->get();
        return response()->view('cms.problem.edit',compact('sparePartModels','problem'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
     //
    $validator = Validator($request->all(), [
    //    'd_log' => 'required|number',
    //    'd_lat' => 'required|number',
    //    'product_models_id'=>'required',
    ]);
    if (!$validator->fails()) {
        $problem = Problem::findOrFail($id);
        $problem->d_log = $request->input('d_log');
        $problem->d_lat = $request->input('d_lat');
        $problem->product_models_id = $request->input('product_models_id');
        $problem->details = $request->input('details');


        $problem->user_id =auth('user')->user()->id;




        $isSaved = $problem ->save();
        // $isSaved = $request->user()->problem()->save($problem);

        return response()->json(
            ['message' => $isSaved ? __('cms.create_success') : __('cms.create_failed')],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
        );
    } else {
        return response()->json(
            ['message' => $validator->getMessageBag()->first()],
            Response::HTTP_BAD_REQUEST,
        );
    }
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $problem=Problem::where('id',$id)->first();
        $isDeleted = $problem->delete();
        return response()->json(['message' => 'Deleted successfully'], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
