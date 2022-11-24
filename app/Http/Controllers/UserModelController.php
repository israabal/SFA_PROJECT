<?php
   namespace App\Http\Controllers;
    
   use App\Models\ProductModel;
use App\Models\SModel;
use App\Models\UserModel;
use App\Models\UsersEquipment;
   use Illuminate\Http\Request;
   use Symfony\Component\HttpFoundation\Response;
   
 

class UserModelController extends Controller
{
 public function indexUserModels()
{
            $user_models = UserModel::all();
            return response()->view('cms.user_model.index', ['user_models' => $user_models]);
        }
        public function editUserModels()
        {
            $user = auth()->user();
            $userModels = $user->smodels;
            $models = SModel::where('active', 1)->get();
            foreach ($models as $model) {
                $model->setAttribute('granted', false);
                foreach ($userModels as $userModel) {
                    if ($userModel->id == $model->id) {
                        $model->setAttribute('granted', true);
                        break;
                    }
                }
            }
        return response()->view('cms.user_model.create', ['models' => $models]);
        }
        public function updateUserModels(Request $request)
        {
            $validator = Validator($request->all(), [
                'product_models_id' => 'required|numeric|exists:s_models,id',
            ]);
            if (!$validator->fails()) {
                $userequipment = UserModel::where('model_id', $request->get('product_models_id'))->first();
                if ($userequipment == null) {
                    $this->addModels($request->get('product_models_id'));
                } else {
                    $this->deleteModels($userequipment->id);
                }
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
        public function addModels($product_models_id)
        {
            $userequipment = new UserModel();
            $userequipment->user_id = auth('user')->user()->id;
            $userequipment->model_id = $product_models_id;
            $isSaved = $userequipment->save();
        }
        public function deleteModels($id)
        {
            $models = UserModel::where('id', $id)->first();
            $isDeleted = $models->delete();
        }
    }
    

