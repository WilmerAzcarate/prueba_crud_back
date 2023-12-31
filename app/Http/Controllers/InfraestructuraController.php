<?php

namespace App\Http\Controllers;

use App\Models\Infraestructura;
use Illuminate\Http\Request;

class InfraestructuraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = InfraEstructura::with(['sede','area']) -> get();
        return response() -> json(['InfraEstructura' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new InfraEstructura();
        $post -> nombreInfraestructura = $request -> nombreInfraestructura;
        $post -> capacidad = $request -> capacidad;
        $post -> descripcion = $request -> descripcion;
        $post -> idArea = $request -> idArea;
        $post -> idSede = $request -> idSede;

        $res = $post -> save();
        if($res){
            return response() ->  json(
                [
                    'message' => (
                        'InfraEstructura '
                        .$post -> nombreInfraestructura
                        .' subida correctamente'
                    )
                ],
                201
            );
        }
        return response() -> json(
            ['error' => 'te falto introducir un dato'],
            500
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $infraestructura = InfraEstructura::with(['sede','area']) -> find($id);
        return response() -> json(['Infraestructura'=> $infraestructura]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request -> validate([
            'nombreInfraestructura' => 'required',
            'capacidad' => 'required',
            'descripcion' => 'required',
            'idArea' => 'required',
            'idSede' => 'required'
        ]);

        $registro = InfraEstructura::findOrFail($id);

        $registro -> nombreInfraestructura = $request -> nombreInfraestructura;
        $registro -> capacidad = $request -> capacidad;
        $registro -> descripcion = $request -> descripcion;
        $registro -> idArea = $request -> idArea;
        $registro -> idSede = $request -> idSede;

        $registro -> save();

        return response() -> json(['actualizado' => $registro]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $infraestructura = InfraEstructura::findOrFail($id);
        $nombre = $infraestructura -> nombreInfraestructura;
        $infraestructura -> delete();
        return response() -> json(['Se elimino: '.$nombre]);
    }
}
