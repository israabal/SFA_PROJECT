<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\ProductModel;
use App\Models\SparePart;
use App\Models\SparePart_ProductModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SparePartController extends Controller
{
    public function index()
    {
        // $spare_parts = ProductModel::all();
        // $spareparts=SparePart::all();
        $spareparts = SparePart::withCount('productmodels')->get();

        return response()->view('cms.spare_part.index', ['spareparts' => $spareparts]); 
    
    }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages=Language::all();
         $product_models = ProductModel::where('active', '=', true)->get();
        return response()->view('cms.spare_part.create', ['product_models' => $product_models,'languages'=>$languages]);
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
            'OEM_Part_Number' => 'required|string|min:3',
            'Katun_Part_Number' => 'required|string|min:3',
            'Local_Number' => 'required|string|min:3',
            'price'=>'required|string|min:3',

        ]);



        if (!$validator->fails()) {

            $spare_part = new SparePart();
            $spare_part->OEM_Part_Number = $request->input('OEM_Part_Number');
            $spare_part->Katun_Part_Number = $request->input('Katun_Part_Number');
            $spare_part->Local_Number = $request->input('Local_Number');
            $spare_part->price = $request->input('price');
            $isSaved = $spare_part->save();

             $spare_part->spareparttranslation->create(

               
            );
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );

        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function editSparepartModels(Request $request,  $id)
    {
        $sparepart=SparePart::Where('id',$id)->first();
        $product_models = ProductModel::where('active',1)->get();
        $sparepart_models = $sparepart->productmodels;
        if (count($sparepart_models) > 0) {
            foreach ($product_models as $product_model) {
                $product_model->setAttribute('assigned', false);
                foreach ($sparepart_models as $sparepart_model) {
                    if ($product_model->id == $sparepart_model->id) {
                        $product_model->setAttribute('assigned', true);
                    }
                }
            }
        }
        return response()->view('cms.spare_part.sparepart-models', ['sparepart' => $sparepart, 'product_models' => $product_models]);
    }




    public function updateSparepartModels(Request $request)
    {
        $validator = Validator($request->all(), [
            'productmodel_id' => 'required|numeric|exists:product_models,id',
            'sparePart_id' => 'required|numeric|exists:spare_parts,id',
        ]);

        if (!$validator->fails()) {
            $sparePartModels=SparePart_ProductModel::where('product_model_id',$request->get('productmodel_id'))->where('spare_part_id',$request->get('sparePart_id'))->first();      
            if ($sparePartModels==null) {
                $this->addModels($request->get('sparePart_id'),$request->get('productmodel_id'));
            } else {

                $this->deleteModels($sparePartModels);            }
            return response()->json(
                ['message' => 'Models updated successfully'],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }



    public function addModels($spare_part_id,$product_model_id)
    {
            $spaerpart_productmodel = new SparePart_ProductModel();
            $spaerpart_productmodel->spare_part_id = $spare_part_id;
            $spaerpart_productmodel->product_model_id = $product_model_id;
            $isSaved = $spaerpart_productmodel->save();
    }


    public function deleteModels(SparePart_ProductModel $models)
    {
        $isDeleted = $models->delete();
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
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SparePart $sparepart)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


    }



}
