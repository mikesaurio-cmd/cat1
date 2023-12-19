<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empresas']=Empresas::paginate(5);
        return view ('empresas.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('empresas.create');
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
        //$datosEmpresa = request()->all();
        //dd($request);
        

        $campos=[
            'nombreEmpresa'=>'required|string|max:100',
            'contacto'=>'required|string|max:100',
            'telefono'=>'required|string|max:100',
            'correo'=>'required|email',
        ];
        $mensaje=[
            
            'nombreEmpresa.required'=>'El nombre es requerido.',
            'contacto.required'=>'El apellido paterno es requerido.',
            'telefono.required'=>'El apellido materno es requerido.',
            'correo.required'=>'El correo es requerido.',
        ];

        $this->validate($request, $campos,$mensaje);
        
        $fecha = carbon::now();
                    
        DB::table('empresas')->insert([
            "nomEmpresa" => $request->nombreEmpresa,
            "contacto" => $request->contacto,
            "telefono" => $request->telefono,
            "correo" => $request->correo,
            "dateCreation" => $fecha,
            "updateCreation" => '',
        ]);

        return redirect ('empresas')->with('mensaje','Empresa agregada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function show(Empresas $empresas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empresa = Empresas::findOrFail($id);
        //dd($empresa);
        return view('empresas.edit',compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $campos=[
            'nombreEmpresa'=>'required|string|max:100',
            'contacto'=>'required|string|max:100',
            'telefono'=>'required|string|max:100',
            'correo'=>'required|email',
        ];
        $mensaje=[
            
            'nombreEmpresa.required'=>'El nombre es requerido.',
            'contacto.required'=>'El apellido paterno es requerido.',
            'telefono.required'=>'El apellido materno es requerido.',
            'correo.required'=>'El correo es requerido.',
        ];

        $this->validate($request, $campos,$mensaje);

        $fecha = carbon::now();
        DB::table('empresas')->where('id',$id)->update([
            "nomEmpresa" => $request->nombreEmpresa,
            "contacto" => $request->contacto,
            "telefono" => $request->telefono,
            "correo" => $request->correo,
            "updateCreation" => $fecha,
        ]);

        $empresa = Empresas::findOrFail($id);
        //return view('empresas.edit',compact('empresa'));

        return redirect('empresas')->with('mensaje','Empresa modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Empresas::destroy($id);
        return redirect('empresas');
    }
}
