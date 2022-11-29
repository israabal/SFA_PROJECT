<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
class ProfileController extends Controller
{
    public function EditProfile()
    {
        return response()->view('cms.profile.profile_view');
    }
    public function profileUpdate(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $user = auth()->user();
            $user->name = $request->input('name');
            if ($request->hasFile('image')) {
                Storage::delete($user->image);
                $imagetitle =  time() . '_'. str_replace(' ','',$user->name).'.'. $request->file('image')->extension();
                if( auth('admin')->check()){
                    $request->file('image')->storePubliclyAs('admins', $imagetitle,['disk'=>'public']);
                    $user->image = 'admins/'.$imagetitle;
                }else{
                    $request->file('image')->storePubliclyAs('users', $imagetitle,['disk'=>'public']);
                    $user->image = 'users/'.$imagetitle;
                }

            }
            $isSaved = $user->save();
            return response()->json(
                ['message' => $isSaved ? __('cms.Updated_success') : __('cms.Updated_failed')],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
