<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['user']=User::paginate();
        return view('empleados.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de campos
        //dd($request);
        $campos = [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'idPlanta' => 'required|string|max:100',
        ];
        
        $mensaje = [
            'name.required' => 'El nombre es requerido.',
            'email.required' => 'El correo es requerido.',
            'password.required' => 'La contraseña es requerida.',
            'role.required' => 'El rol es requerido.',
            'idPlanta.required' => 'El rol es requerido.',
        ];
        
        $this->validate($request, $campos, $mensaje);
        
        // Obtener los datos del formulario, excepto el token CSRF
        $datosEmpleado = $request->except('_token');
        
        // Encriptar la contraseña
        $datosEmpleado['password'] = bcrypt($request->input('password'));
        
        // Agregar la columna 'updated_at' con la fecha actual
        $datosEmpleado['created_at'] = now();
        
        // Insertar el usuario en la base de datos
        User::insert($datosEmpleado);
        
        return redirect('empleado')->with('mensaje', 'Usuario agregado con éxito');        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);

        $infoUser = DB::table('users')->where('id', $id)->first();
        
        return view('empleados.editUsr',['infoUser' => $infoUser,'modo'=>'Editar']);
    }

    public function sendEdit(Request $Request)
    {
        //dd($Request);

        $user = DB::table('users')->where('id', $Request->id)->first();
        $date = Carbon::now();

        if ($user) {
            $updateData = [
                'name' => $Request->filled('name') ? $Request->name : $user->name,
                'email' => $Request->filled('email') ? $Request->email : $user->email,
                'password' => $Request->filled('password') ? bcrypt($Request->password) : $user->password,
                'idPlanta' => $Request->filled('idPlanta') ? $Request->idPlanta : $user->idPlanta,
                'role' => $Request->filled('role') ? $Request->role : $user->role,
                'updated_at' => $date,
                
            ];

            if ($updateData != array_intersect_key((array)$user, $updateData)) {
                DB::table('users')->where('id', $Request->id)->update($updateData);
            }
        }
        
        // return view('empleados.editUsr',['infoUser' => $infoUser,'modo'=>'Editar']);
        return redirect('empleado')->with('mensaje','Usuario modificado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $campos=[
            'nombre'=>'required|string|max:100',
            'paterno'=>'required|string|max:100',
            'materno'=>'required|string|max:100',
            'correo'=>'required|email',
        ];
        $mensaje=[
            
            'nombre.required'=>'El nombre es requerido.',
            'paterno.required'=>'El apellido paterno es requerido.',
            'materno.required'=>'El apellido materno es requerido.',
            'correo.required'=>'El correo es requerido.',
        ];

        $this->validate($request, $campos,$mensaje);
        //
        $datosEmpleado = request()->except(['_token','_method']);
        Empleado::where('id','=',$id)->update($datosEmpleado);

        $empleado=Empleado::findOrFail($id);
        
        //return view('empleados.edit',compact('empleado'));

        return redirect('empleado')->with('mensaje','Empleado modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::destroy($id);
        return redirect('empleado')->with('mensaje','Empleado borrado');
    }
}
