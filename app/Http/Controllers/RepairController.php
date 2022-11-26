<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $this->authorize('viewAny', Repair::class);

        $users=User::where('user_type', 'technical')->get();
        $repair=Repair::with('problem')->get();
        return response()->view('cms.repair.index', compact( 'users','repair'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

        {
            $this->authorize('create', Repair::class);

            $problem=Problem::all();
            $users=User::where('user_type','technical')->get();

            return response()->view('cms.repair.create',compact('users','problem'));

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
        $this->authorize('create', Repair::class);

        $validator = Validator($request->all(), [
            'problem_id' => 'required',
            'technecal_id' => 'required',
            'app_status'=> 'required ',
            // 'product_models_id'=>'required',
            // 'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $repair=Repair::where('problem_id',$request->get('problem_id'))->first();
if($repair==null){
    $repair = new Repair();
    $repair->problem_id = $request->input('problem_id');
    $repair->technecal_id = $request->input('technecal_id');
    $repair->app_status = $request->input('app_status');
    $isSaved = $repair ->save();

    return response()->json(
        ['message' => $isSaved ? __('cms.create_success') : __('cms.create_failed')],
        $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
    );

}else{
    return response()->json(
        ['message' => 'This Problem It Given Technical User'],
        Response::HTTP_BAD_REQUEST,
    );
}


    }
    else {
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $repair = Repair::findOrFail($id);
        $this->authorize('update', $repair);

        $users=User::where('user_type','technical')->get();
        $problem=Problem::all();

        return response()->view('cms.repair.edit',compact('users','repair','problem') );
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
        $validator = Validator($request->all(), [
            // 'd_log' => 'required|number',
            // 'd_lat' => 'required|number',
            // 'active'=> 'required | boolean',
            // 'product_models_id'=>'required',
            // 'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $repair = Repair::findOrFail($id);
            $this->authorize('update', $repair);

            $repair->problem_id = $request->input('problem_id');
            $repair->technecal_id = $request->input('technecal_id');
            $repair->app_status = $request->input('app_status');




        $isSaved = $repair ->save();


        return response()->json(
            ['message' => $isSaved ? __('cms.Updated_success') : __('cms.updated_failed')],
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $repair=Repair::where('id',$id)->first();
        $this->authorize('delete', $repair);

        $isDeleted = $repair->delete();
        return response()->json(['message' => 'Deleted successfully'], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
