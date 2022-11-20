<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategory::all();
        return response()->view('cms.subcategories.index', ['sub_categories' => $sub_categories]);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.subcategories.create');
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
           'name' => 'required|string|min:2',
           'code'=> 'required | string|min:2',
           'active'=> 'required | boolean',

           'image' => 'required|image|mimes:png,jpg,jpeg',

         
       ]);

       if (!$validator->fails()) {
        
           $subcategory = new SubCategory();
           $subcategory->name = $request->input('name');
           $subcategory->code = $request->input('code');
           $subcategory->active = $request->input('active');

           
           if ($request->hasFile('image')) {
            
               $file = $request->file('image');
               $imagetitle =  time().'_subcategory_image.' . $file->getClientOriginalExtension();
               $status = $request->file('image')->storePubliclyAs('images/subcategories', $imagetitle);
               $imagePath = 'images/subcategories/' . $imagetitle;
               $subcategory->image = $imagePath;}


         
               $isSaved = $request->user()->subcategories()->save($subcategory);
           // $category=Category::fideOrFail($request->input('category_id'));
           // $isSaved = $category->subcategories()->save($subcategory);

           return response()->json(
               ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
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
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {

        $subCategory=SubCategory::where('id',$id)->first();


        return response()->view('cms.subcategories.edit', ['subcategory' => $subCategory]);  
      }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'code'=> 'required | string|min:2',
            'active' => 'required|boolean',

           


        ]);
        if (!$validator->fails()) {
            
            $subCategory->name = $request->input('name');
            $subCategory->code = $request->input('code');
            $subCategory->active = $request->input('active');


  

            if ($request->hasFile('image')) {
                //Delete category previous image.
                Storage::delete($subCategory->image);
                //Save new image.
                $file = $request->file('image');
                $imageName = time() . '_subcategory_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/subcategories', $imageName);
                $imagePath = 'images/subcategories/' . $imageName;
                $subCategory->image = $imagePath;
            }
            $isSaved = $request->user()->subcategories()->save($subCategory);
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $subcategory=SubCategory::where('id',$id)->first();

        $deleted = $subcategory->delete();
        if ($deleted) {
            Storage::delete($subcategory->image);
        }
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'subCategory deleted successfully' : 'subCategory deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
