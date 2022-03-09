<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
    }

    public function show($id)
    {
        $material = Material::find($id);

        return view('user-materials-show', compact('material'));
    }
}