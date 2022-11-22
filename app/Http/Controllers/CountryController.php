<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return response()->view('cms.country.index', ['countries' => $countries]);
    }

    public function create()
    {
        return response()->view('cms.country.create');
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
        ]);
        if (!$validator->fails()) {
            $country = new Country();
            $country->name = $request->input('name');
            $isSaved = $country->save();
            return response()->json(
             ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
              $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,);
        }
    }
    public function edit(Country $country)
    {
        return response()->view('cms.country.edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $validator = Validator($request->all(), [
            'name' => 'nullable|string|min:3',           
        ]);
        if (!$validator->fails()) {
            $country->name = $request->input('name');
            $isSaved = $country->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    
    public function destroy(Country $country)
    {
        $deleted = $country->delete();
        
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
