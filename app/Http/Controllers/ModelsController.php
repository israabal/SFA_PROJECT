<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Models;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Models::all();
        return response()->view('cms.modelss.index', ['models' => $models]);       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('active', '=', true)->get();
        $subcategories = SubCategory::where('active', '=', true)->get();

        return response()->view('cms.modelss.create', ['categories' => $categories,'subcategories'=>$subcategories]);    }

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
            'sup_category_id'=>'required|numeric|exists:sup_categories,id',
            // 'vendor_id'=>'required|numeric|exists:vendors,id',
            'description' => 'required|string|min:3',
            'price' => 'required|string|min:3',
            'active'=> 'required | boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg',

          
        ]);

        if (!$validator->fails()) {
            $model = new Models();
            $model->name = $request->input('name');
            $model->sub_category_id = $request->input('sub_category_id');
            $model->category_id = $request->input('category_id');

            $model->admin_id = $request->input('admin_id');
      
            $model->active = $request->input('active');
          



          
        }
       }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models  $models
     * @return \Illuminate\Http\Response
     */
    public function show(Models $models)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models  $models
     * @return \Illuminate\Http\Response
     */
    public function edit(Models $models)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models  $models
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Models $models)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models  $models
     * @return \Illuminate\Http\Response
     */
    public function destroy(Models $models)
    {
        //
    }
}
