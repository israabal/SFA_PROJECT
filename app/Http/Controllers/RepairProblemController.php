<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\RepairProblem;
use App\Models\SparePart;
use App\Models\SparePartModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RepairProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $repairProblem = RepairProblem::withCount('SparePart')->get();

        $repairs = Repair::where('technecal_id', auth('user')->user()->id)->withCount('spareparts')->get();
        return response()->view('cms.repair_problem.index', compact('repairs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
        $validator = Validator($request->all(), [
            'details'=>'required',
            'app_status'=>'required',
        ]);
        if (!$validator->fails()) {
            $repairProblem = RepairProblem::where('problems_id',$request->input('problem_id'))->first();

if( $repairProblem==null){
    $repairProblem = new RepairProblem();
    $repairProblem->problems_id = $request->input('problem_id');
    $repairProblem->details = $request->input('details');
    $repairProblem->app_status = $request->input('app_status');
    $repairProblem->repairs_id = $request->input('repair_id');
    $isSaved = $repairProblem->save();

    return response()->json(
        ['message' => $isSaved ? __('cms.create_success') : __('cms.create_failed')],
        $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
    );
}else{

    $repairProblem->details = $request->input('details');
    $repairProblem->app_status = $request->input('app_status');
    $isSaved = $repairProblem->save();

    return response()->json(
        ['message' => $isSaved ? __('cms.Updated_success') : __('cms.Updated_failed')],
        $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
    );


}

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repair = Repair::where('id', $id)->first();


        // $spareParts=SparePartModel::where('s_model_id',$repair->problem->model->id)->with('sparePart')->get();


        $spareParts = SparePart::all();


       $repair_spareParts = $repair->spareparts;




        if (count($repair_spareParts) > 0) {
            foreach ($spareParts as $smodel) {
                $smodel->setAttribute('assigned', false);
                foreach ($repair_spareParts as $sparepart_model) {
                    if ($smodel->id == $sparepart_model->id) {
                        $smodel->setAttribute('assigned', true);
                    }
                }
            }
        }


        return response()->view('cms.repair_spare_part.index', compact('repair', 'spareParts'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
