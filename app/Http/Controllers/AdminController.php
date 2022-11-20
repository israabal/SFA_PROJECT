<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
      $this-> authorizeResource(Admin::class, 'admin');
     }
    public function index()
    {
        $admins = Admin::all();
        return response()->view('cms.admin.index', ['admins' => $admins]);
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::where('guard_name','admin')->get();
        return response()->view('cms.admin.create',['roles'=>$roles]);
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
                'name' => 'required|string|min:3',
                'email' => 'required|email|unique:admins',
                'active'=> 'required | boolean',
                'role_id'=>'required',
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ]);
            if (!$validator->fails()) {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->active = $request->input('active');
            $admin->password = Hash::make(12345);
            if ($request->hasFile('image')) {

                $file = $request->file('image');
                $imagetitle =  time().'_admin_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/admins', $imagetitle);
                $imagePath = 'images/admins/' . $imagetitle;
                $admin->image = $imagePath;}



            $isSaved = $admin->save();

            if($isSaved){
                $admin->assignRole(Role::findById($request->get('role_id')));
            }
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return response()->view('cms.admin.edit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:admins,email,'. $admin->id,
            'active' => 'required|boolean',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {

            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->active = $request->input('active');

            if ($request->hasFile('image')) {
                //Delete admin previous image.
                Storage::delete($admin->image);
                //Save new image.
                $file = $request->file('image');
                $imageName = time() . '_admin_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/admins', $imageName);
                $imagePath = 'images/admins/' . $imageName;
                $admin->image = $imagePath;
            }
            $isSaved = $admin->save();
            return response()->json(
                ['message' => $isSaved ? __('cms.Updated_success') : __('cms.Updated_failed')],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if(!auth('admin')->user()->id!=$admin->id){
            $deleted = $admin->delete();
            if ($deleted) {
                Storage::delete($admin->image);
            }
            return response()->json(
                ['message' => $deleted ? __('cms.Deleted_successfully') : __('cms.Delete_failed!')],
                $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        }else{
            return response()->json(
                ['message' => 'You Can\'t Delete Your Self '],
                 Response::HTTP_BAD_REQUEST
            );
        }

    }
}
