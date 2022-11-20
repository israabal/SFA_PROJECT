<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\ProductModel;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProductModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_models = ProductModel::all();
        return response()->view('cms.productmodel.index', ['product_models' => $product_models]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('active', '=', true)->get();
        $subcategories = SubCategory::where('active', '=', true)->get();

        return response()->view('cms.productmodel.create', ['categories' => $categories, 'subcategories' => $subcategories]);
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
            'sub_category_id' => 'required|numeric|exists:sub_categories,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'active' => 'required | boolean',
            'image_1' => 'required|image|mimes:png,jpg,jpeg',
            'image_2' => 'nullable', 'image|mimes:png,jpg,jpeg',
            'image_3' => 'nullable', 'image|mimes:png,jpg,jpeg',
            'image_4' => 'nullable', 'image|mimes:png,jpg,jpeg',
            'image_5' => 'nullable', 'image|mimes:png,jpg,jpeg',


        ]);

        if (!$validator->fails()) {
            $product_model = new ProductModel();
            $product_model->name = $request->input('name');
            $product_model->sub_category_id = $request->input('sub_category_id');
            $product_model->category_id = $request->input('category_id');
            $product_model->active = $request->input('active');

            $isSaved = $request->user()->models()->save($product_model);
            if ($isSaved) {

                $this->saveImage($request, $product_model, 'image_1');
                $this->saveImage($request, $product_model, 'image_2');
                $this->saveImage($request, $product_model, 'image_3');
                $this->saveImage($request, $product_model, 'image_4');
                $this->saveImage($request, $product_model, 'image_5');
            }
            return response()->json(
                ['message' => $isSaved ? __('cms.create_success') : __('cms.create_failed')],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $productModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productModel=ProductModel::where('id',$id)->first();
        $categories = Category::where('active', '=', true)->get();
        $subcategories = SubCategory::where('active', '=', true)->get();
        return response()->view('cms.productmodel.edit', ['productModel' => $productModel, 'categories' => $categories, 'subcategories' => $subcategories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductModel $productModel)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'sub_category_id' => 'required|numeric|exists:sub_categories,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'active' => 'required | boolean',
            'image_1' => 'required|image|mimes:png,jpg,jpeg',
            'image_2' => 'nullable', 'image|mimes:png,jpg,jpeg',
            'image_3' => 'nullable', 'image|mimes:png,jpg,jpeg',
            'image_4' => 'nullable', 'image|mimes:png,jpg,jpeg',
            'image_5' => 'nullable', 'image|mimes:png,jpg,jpeg',


        ]);
        if (!$validator->fails()) {
            $productModel->name = $request->input('name');
            $productModel->sub_category_id = $request->input('sub_category_id');
            $productModel->category_id = $request->input('category_id');
            $productModel->active = $request->input('active');

            $isSaved = $request->user()->models()->save($productModel);
            if ($isSaved) {

                $this->saveImage($request, $productModel, 'image_1');
                $this->saveImage($request, $productModel, 'image_2');
                $this->saveImage($request, $productModel, 'image_3');
                $this->saveImage($request, $productModel, 'image_4');
                $this->saveImage($request, $productModel, 'image_5');
            }
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
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $productModel=ProductModel::where('id',$id)->first();

        $deleted = $productModel->delete();
        if ($deleted) {
            $this->deleteImages($productModel);
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




    private function deleteImages(ProductModel $productModel)
    {
        foreach ($productModel->images as $image) {
            Storage::disk('public')->delete('productmodels/' . $image->name);
            $image->delete();
        }
    }

    private function saveImage(Request $request, ProductModel $productModel, String $key, bool $update = false)
    {
        if ($request->hasFile($key)) {
            if ($update) {
                foreach ($productModel->images as $image) {
                    if (str_contains($image->name, $key)) {
                        Storage::disk('public')->delete('productmodels/' . $image->name);
                        $image->delete();
                    }
                }
            }
            $imageName = time() . '_' . str_replace(' ', '', $productModel->name) . "_model_$key." . $request->file($key)->extension();
            $request->file($key)->storePubliclyAs('productmodels', $imageName, ['disk' => 'public']);

            $image = new Image();
            $image->name = $imageName;
            $image->url = 'productmodels/' . $imageName;
            $productModel->images()->save($image);
        }
    }
}
