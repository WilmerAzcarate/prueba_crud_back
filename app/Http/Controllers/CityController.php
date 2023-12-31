<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =City::with(['departamento','sedes']) -> get();
        return response() -> json(['Ciudades' => $data]);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data =City::with(['departamento','sedes']) -> find($id);
        return response() -> json(['Ciudades' => $data]);
    }
}
