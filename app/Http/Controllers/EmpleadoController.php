<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = DB::table('empleado')
                        ->join('areas', 'empleado.area_id', '=', 'areas.id')
                        ->select('empleado.nombre', 'empleado.email','empleado.sexo', 'empleado.id', 'empleado.boletin', 'areas.nombre AS area')->get();
        return response()->json(['empleados' => $empleados]);
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
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string',
            'correo' => 'required|email',
            'sexo' => 'required|string',
            'descripcion' => 'required|string',
            'area' => 'required',
        ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return response()->json(['error' => 400, 'errors' => $errors->all()]);
        }else{
            $dato = Empleado::create([
                'nombre' => $request->nombre,
                'email' => $request->correo,
                'sexo' => $request->sexo,
                'boletin' => $request->boletin,
                'descripcion' => $request->descripcion,
                'area_id' => $request->area
            ]);
            return response()->json(['msg' => 'Creacion exitosa']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $empleado = Empleado::find($request);
        return response()->json(['empleado' => $empleado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $datos = $request->all();
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string',
            'correo' => 'required|email',
            'sexo' => 'required|string',
            'descripcion' => 'required|string',
            'area' => 'required',
        ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return response()->json(['error' => 400, 'error' => $errors->all()]);
        }else{
            $dato = DB::table('empleado')
              ->where('id', $request->id)
              ->update([
                'nombre' => $request->nombre,
                'email' => $request->correo,
                'sexo' => $request->sexo,
                'descripcion' => $request->descripcion,
                'area_id' => $request->area,
                'boletin' => $request->boletin
            ]);
            return response()->json(['msg' => 'Empleado actualizado']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $empleado = Empleado::find($request);
        Empleado::destroy($empleado);
        return response()->json(['msg' => 'Empleado eliminado']);
    }
}
