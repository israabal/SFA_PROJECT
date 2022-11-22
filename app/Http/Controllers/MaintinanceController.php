<?php

namespace App\Http\Controllers;

use App\Models\MaintinanceApp;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class MaintinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maint=MaintinanceApp::all();
        $users=User::where('roles','technical')->get();
        return response()->view('cms.maintinance.index', compact('users','maint'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users=User::all();
        $users=User::where('roles','technical')->get();

        return response()->view('cms.maintinance.create',compact('users'));

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
            // 'd_log' => 'required|number',
            // 'd_lat' => 'required|number',
            // 'active'=> 'required | boolean',
            // 'technecal_id'=>'required',
            // 'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
        $maint = new MaintinanceApp();
        $maint->d_log = $request->input('d_log');
        $maint->d_lat = $request->input('d_lat');
        $maint->active = $request->input('active');
        $maint->technecal_id = $request->input('technecal_id');
        $maint->app_status = $request->input('app_status');






        $isSaved = $maint->save();

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
        $maint = MaintinanceApp::findOrFail($id);
        $users=User::where('roles','technical')->get();

        return response()->view('cms.maintinance.edit', compact('maint','users'));
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
            // 'technecal_id'=>'required',
            // 'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
       $maint = MaintinanceApp::findOrFail($id);
        $maint->d_log = $request->input('d_log');
        $maint->d_lat = $request->input('d_lat');
        $maint->active = $request->input('active');
        $maint->technecal_id = $request->input('technecal_id');
        $maint->app_status = $request->input('app_status');






        $isSaved = $maint->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $maint=MaintinanceApp::where('id',$id)->first();
        $isDeleted = $maint->delete();
        return response()->json(['message' => 'Deleted successfully'], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
