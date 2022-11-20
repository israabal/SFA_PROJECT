<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    public function index()
    {
        return response()->view('cms.spare_part.index');    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $spareparts = SparePart::all();
        return response()->view('cms.spare_part.create');
    }

}
