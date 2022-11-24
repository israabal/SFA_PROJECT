<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function registerview()
    {
        $countries =  DB::table('countries')->get();
        return response()->view('cms.register.create',['countries'=>$countries]);
    }
    public function register(Request $request){
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'city_id' =>'required',
            'country_id' =>'required',
            'region' =>'required',
            'image'=>'nullable',
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->user_type='customers';
            $user->email = $request->input('email');
            $user->country_id = $request->input('country_id');
            $user->city_id = $request->input('city_id');
            $user->region = $request->input('region');
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
