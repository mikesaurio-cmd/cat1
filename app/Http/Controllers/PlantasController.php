<?php

namespace App\Http\Controllers;

use App\Models\plantas;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlantasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['plantas']=plantas::paginate(5);
        return view ('plantas.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('plantas.create');
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
        $campos=[
            'nombrePlanta'=>'required|string|max:100',
            'contactoPlanta'=>'required|string|max:100',
            'telefonoPlanta'=>'required|string|max:100',
            'correoPlanta'=>'required|email',
        ];
        $mensaje=[
            
            'nombrePlanta.required'=>'El nombre de la planta es requerido.',
            'contactoPlanta.required'=>'El contacto de la planta es requerido.',
            'telefonoPlanta.required'=>'El telefono de la planta es requerido.',
            'correoPlanta.required'=>'El correo de la planta es requerido.',
        ];

        $this->validate($request, $campos,$mensaje);

        //dd($request);
        $fecha = carbon::now();
                    
        DB::table('plantas')->insert([
            "nombrePlanta" => $request->nombrePlanta,
            "contactoPlanta" => $request->contactoPlanta,
            "telefonoPlanta" => $request->telefonoPlanta,
            "correoPlanta" => $request->correoPlanta,
            "dateCreation" => $fecha,
            "updateCreation" => '',
        ]);

        return redirect ('plantas')->with('mensaje','Planta agregada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\plantas  $plantas
     * @return \Illuminate\Http\Response
     */
    public function show(plantas $plantas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\plantas  $plantas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $planta = plantas::findOrFail($id);
        //dd($empresa);
        return view('plantas.edit',compact('planta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\plantas  $plantas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'nombrePlanta'=>'required|string|max:100',
            'contactoPlanta'=>'required|string|max:100',
            'telefonoPlanta'=>'required|string|max:100',
            'correoPlanta'=>'required|email',
        ];
        $mensaje=[
            
            'nombrePlanta.required'=>'El nombre de la planta es requerido.',
            'contactoPlanta.required'=>'El contacto de la planta es requerido.',
            'telefonoPlanta.required'=>'El telefono de la planta es requerido.',
            'correoPlanta.required'=>'El correo de la planta es requerido.',
        ];

        $this->validate($request, $campos,$mensaje);

        $fecha = carbon::now();
        DB::table('plantas')->where('id',$id)->update([
            "nombrePlanta" => $request->nombrePlanta,
            "contactoPlanta" => $request->contactoPlanta,
            "telefonoPlanta" => $request->telefonoPlanta,
            "correoPlanta" => $request->correoPlanta,
            "updateCreation" => $fecha,
        ]);

        $planta = plantas::findOrFail($id);
        //return view('empresas.edit',compact('empresa'));

        return redirect('plantas')->with('mensaje','Planta modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\plantas  $plantas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        plantas::destroy($id);
        return redirect('plantas');
    }
}
