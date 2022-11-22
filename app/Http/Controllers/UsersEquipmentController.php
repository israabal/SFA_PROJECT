<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Http\Request;

class UsersEquipmentController extends Controller
{
    public function editSparepartModels(Request $request,  $id)
    {
        $user=User::Where('id',$id)->first();
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
   

}
