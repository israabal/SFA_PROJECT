<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        $request->merge(['guard' => $request->guard]);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:admin,user,store'
        ]);
        session()->put('guard', $request->input('guard'));
        if (!$validator->fails()) {
            return response()->view('cms.auth.login', ['guard' => $request->guard]);
        } else {
            abort(404);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string|min:3|max:10',
            'remember' => 'required|boolean',
        ]);

        $guard = session('guard');
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
        if (!$validator->fails()) {
            if (Auth::guard($guard)->attempt($credentials, $request->get('remember'))) {
                // Language::all();
                return response()->json(['message' => 'Logged in successfully'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Error credentials, please try again'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function editPassword()
    {
        return response()->view('cms.auth.edit-password');
    }
    public function updatePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'password' => 'required|current_password:' . 'admin',
            'new_password' => ['required', 'confirmed', Password::min(8)->letters()->symbols()->numbers()->mixedCase()->uncompromised()],

        ]);
        if (!$validator->fails()) {
            $user = $request->user();
            $user->forceFill(
                ['password' => Hash::make($request->input('new_password'))]
            );
            $isSaved = $user->save();

            return response()->json(
                ['message' => $isSaved ? 'Updated successfully' : 'Updated Failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
    public function logout(Request $request)
    {
        $guard = session('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('cms.login', $guard);
    }
}