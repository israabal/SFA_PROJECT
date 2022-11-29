<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Problem;
use App\Models\Repair;
use App\Models\SModel;
use App\Models\SparePart;
use App\Models\User;
use App\Models\UserModel;

class DashboardController extends Controller
{

    public function index()
    {
        $users = User::all();
        $technical = $users->Where('user_type', '=', 'technical')->count();
        $agent = $users->Where('user_type', '=', 'agent')->count();
        $customer = $users->Where('user_type', '=', 'customers')->count();
        $brand = Brand::all()->count();
        $category = Category::all()->count();
        $spare_part = SparePart::all()->count();
        $model = SModel::all()->count();
        $problems = Problem::all();
        $problem = $problems->count();
        $problms = Problem::latest()->limit(10)->get();
        $usermodel = UserModel::all()->count();
        if (auth('admin')->check()) {
            return response()->view('cms.dashboard.dashboard', [
                'users' => $users, 'spare_part' => $spare_part, 'brand' => $brand,
                'category' => $category, 'model' => $model, 'problem' => $problem,
                'usermodel' => $usermodel, 'technical' => $technical, 'agent' => $agent, 'customer' => $customer,
            ]);
        } else {

            if (auth('user')->user()->user_type == 'agent') {

                return response()->view('cms.dashboard.dashboard', [
                    'problms' => $problms,
                ]);
            } elseif (auth('user')->user()->user_type == 'technical') {
                $rep = Repair::where('technecal_id', auth('user')->user()->id)->latest()->limit(10)->get();
                return response()->view('cms.dashboard.dashboard', ['rep' => $rep]);
            } else {

                $probl = Problem::where('user_id', auth('user')->user()->id)->latest()->limit(10)->get();

                return response()->view('cms.dashboard.dashboard', ['probl' => $probl]);
            }
        }
    }
}
