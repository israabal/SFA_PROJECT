<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\SparePart;
use App\Models\SparePart_ProductModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SparePartProductModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index($request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 

      
  


      }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SparePart_ProductModel  $sparePart_ProductModel
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SparePart_ProductModel  $sparePart_ProductModel
     * @return \Illuminate\Http\Response
     */
    public function edit(SparePart_ProductModel $sparePart_ProductModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SparePart_ProductModel  $sparePart_ProductModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SparePart_ProductModel $sparePart_ProductModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SparePart_ProductModel  $sparePart_ProductModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SparePart_ProductModel $sparePart_ProductModel)
    {
        //
    }
}
