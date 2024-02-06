<?php

namespace App\Http\Controllers;

use App\Models\nopartes;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NopartesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['nopartes']=nopartes::paginate();
        return view ('nopartes.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('nopartes.create');
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
        //dd($request);
        $campos=[
            'noParte'=>'required|string|max:100',
            'nombreParte'=>'required|string|max:100',
            'descriParte'=>'required|string|max:100',
        ];
        $mensaje=[
            
            'noParte.required'=>'El número de parte es requerido.',
            'nombreParte.required'=>'El nombre de la parte es requerido.',
            'descriParte.required'=>'La descripción de la parte es requerido.',
        ];

        $this->validate($request, $campos,$mensaje);

        //dd($request);
        $fecha = carbon::now();
                    
        DB::table('nopartes')->insert([
            "noParte" => $request->noParte,
            "nombreParte" => $request->nombreParte,
            "descripcion" => $request->descriParte,
            "dateCreation" => $fecha,
            "updateCreation" => '',
        ]);

        return redirect ('nopartes')->with('mensaje','Parte agregada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nopartes  $nopartes
     * @return \Illuminate\Http\Response
     */
    public function show(nopartes $nopartes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nopartes  $nopartes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $nopartes = nopartes::findOrFail($id);
        //dd($empresa);
        return view('nopartes.edit',compact('nopartes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\nopartes  $nopartes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'noParte'=>'required|string|max:100',
            'nombreParte'=>'required|string|max:100',
            'descriParte'=>'required|string|max:100',
        ];
        $mensaje=[
            
            'noParte.required'=>'El número de parte es requerido.',
            'nombreParte.required'=>'El nombre de la parte es requerido.',
            'descriParte.required'=>'La descripción de la parte es requerido.',
        ];

        $this->validate($request, $campos,$mensaje);

        $fecha = carbon::now();
        
        DB::table('nopartes')->where('id',$id)->update([
            "noParte" => $request->noParte,
            "nombreParte" => $request->nombreParte,
            "descripcion" => $request->descriParte,
            "dateCreation" => $fecha,
            "updateCreation" => '',
        ]);

        $noparte = nopartes::findOrFail($id);
        //return view('empresas.edit',compact('empresa'));

        return redirect('nopartes')->with('mensaje','No. de pieza modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nopartes  $nopartes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        nopartes::destroy($id);
        return redirect('nopartes');
    }
}
