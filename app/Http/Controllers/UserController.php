<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Hash;
use Str;

class UserController extends Controller
{



    public function __construct()
    {
     $this-> authorizeResource(User::class, 'user');
    }


    public function index()
    {
        $users = User::all();
        return response()->view('cms.users.index', ['users' => $users]);
    }


    public function create()
    {
        return response()->view('cms.users.create');
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
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'user_type' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->user_type = $request->input('user_type');
            // $user->password = Hash::make(12345);
            $user->password = Hash::make(Str::random(8));

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imagetitle =  time() . '_user_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/users', $imagetitle);
                $imagePath = 'images/users/' . $imagetitle;
                $user->image = $imagePath;
            }
            $isSaved = $user->save();
            return response()->json(
             ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
              $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,);
        }
    }
    public function edit(User $user)
    {
        return response()->view('cms.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'name' => 'nullable|string|min:3',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'user_type' => 'required',
            'image' => 'nullable', 'image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->user_type = $request->input('user_type');
            if ($request->hasFile('image')) {
                //Delete admin previous image.
                Storage::delete($user->image);
                //Save new image.
                $file = $request->file('image');
                $imageName = time() . '_user_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/users', $imageName);
                $imagePath = 'images/users/' . $imageName;
                $user->image = $imagePath;
            }
            $isSaved = $user->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function UserActive($id)
    {
        $user = User::Where('id', '=', $id)->first();

        $user->status = !$user->status;
        $user->save();
        return response()->json(
            ['message' => $user ? 'Change Status successfully' : 'Change Status failed!'],
            $user ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
    public function destroy(User $user)
    {
        $deleted = $user->delete();
        if ($deleted) {
            Storage::delete($user->image);
        }
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
    public function registerview()
    {
        return response()->view('cms.register.create');
    }
    public function register(Request $request){
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'image'=>'nullable',
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->user_type='customers';
            $user->email = $request->input('email');
            $user->password = Hash::make('password');;
            $isSaved = $user->save();
            return response()->json(
             ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
              $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,);
        }
    }
   
}

