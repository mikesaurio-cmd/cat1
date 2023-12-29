<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    //
    public function formulario()
        {
            $empresa = DB::table('empresas')->get();
            $planta = DB::table('plantas')->get();
            $noparte = DB::table('nopartes')->get();
            
            return view('form',['empresa' => $empresa, 'planta' => $planta,'noparte' => $noparte]);
        }

        public function enviarInfo(Request $request)
        {

            //dd($request);

            
            // Obtener los valores del formulario
            $empresa = $request->input('noParte');
            $planta = $request->input('planta');
            $noparte = $request->input('noparte');
            $cantidad = $request->input('cantidad');
            $fechaMantenimiento = $request->input('mantenimiento');
        
            // Obtener la fecha de creación
            $dateCreation = now(); // Esto utiliza la fecha y hora actual
        
            // Obtener el último número de registro para el noparte específico
            $ultimoRegistro = DB::table('tbl_registros')
                ->where('noparte', $noparte)
                ->orderBy('noRegistro', 'desc')
                ->first();
        
            $ultimoNumero = 1; // Valor predeterminado si no se encuentra ningún registro anterior
        
            if ($ultimoRegistro) {
                // Si se encuentra un registro anterior, extraer el número de registro y sumar 1
                $ultimoNumero = (int) explode('_', $ultimoRegistro->noRegistro)[1] + 1;
            }
        
            // Verificar si el número ya existe en la base de datos
            while (DB::table('tbl_registros')->where('noRegistro', $noparte . '_' . $ultimoNumero)->exists()) {
                $ultimoNumero++; // Incrementar el número hasta encontrar uno único
            }
        
            for ($i = 0; $i < $cantidad; $i++) {

                // Crear el valor para la columna noRegistro
                $noRegistro = $noparte . '_' . $ultimoNumero;
        
                // Generar el código QR
                $qrPath = public_path('qr_codes/' . $noRegistro . '.png');
                $qrUrl = url('mostrarInformacion/' . $noRegistro);
                $qrCode = QrCode::format('png')->size(200)->generate($qrUrl);
                file_put_contents($qrPath, $qrCode);

                $imagenes = $request->file('imagen')->store('public/img');
                $url = Storage::url($imagenes);

                // Crear un nuevo registro en la tabla
                DB::table('tbl_registros')->insert([
                    'empresa' => $empresa,
                    'planta' => $planta,
                    'noparte' => $noparte,
                    'noRegistro' => $noRegistro,
                    'dateCreation' => $dateCreation,
                    'updateCreation' => $fechaMantenimiento,
                    'qrPieza' => 'qr_codes/' . $noRegistro . '.png', // Guarda la ubicación del código QR en la columna
                    'img' => $url,
                    
                ]);
        
                $ultimoNumero++; // Incrementar el número para el siguiente registro

            }
        
            // Redireccionar a la página de inicio o realizar cualquier otra acción necesaria
            return redirect('form')->with('mensaje', 'Registros creados con éxito');
        }   

    public function registrosVencen()
        {

            $datos = DB::table('tbl_registros')->where('planta', auth()->user()->idPlanta)->get();

            return view('registrosVencen', ['datos' => $datos]); 
        }

    public function registrosTodos()
    {
        $datos = DB::table('tbl_registros')->where('planta', auth()->user()->idPlanta)->get();
        return view('noregistros_todos', ['datos' => $datos]);
    }

    public function mostrarInformacion($id)
        {
            $registrosTodos = DB::table('tbl_registros')->get();
            $registro = DB::table('tbl_registros')->where('noRegistro', $id)->first();
            
            // Corregir la consulta para obtener la empresa asociada al registro
            $empresa = DB::table('empresas')->where('id', $registro->empresa)->first();
            $planta = DB::table('plantas')->where('id', $registro->planta)->first();

            $mtto = DB::table('tbl_mtto')->where('idRegistro', $registro->IdRegistro)->get();

            return view('qr', compact(['registro', 'empresa', 'registrosTodos', 'planta','mtto']));
        }

    public function irmtto($id)
    
        {
            $registro = DB::table('tbl_registros')->where('IdRegistro', $id)->first();
            return view('form_mtto', compact(['registro'])); 
        }

    public function validarMtto(Request $Request)
        {
            //dd($Request);
            $date = Carbon::now();
            DB::table('tbl_mtto')->insert([
                'idRegistro' => $Request->idRegistro,
                'noRegistro' => $Request->noRegistro,
                'mtto' => $Request->mantenimiento,
                'observaciones' => $Request->observaciones,
                'fechaRevision' => $Request->fechaRevision,
                'proxMtto' => $Request->fechaMtto,
                'dateCreation' => $date,
            ]);

            DB::table('tbl_registros')->update([
                'updateCreation' => $Request->fechaMtto,
            ]);

            return redirect('mostrarInformacion/' . $Request->idRegistro)->with('mensaje', 'Registro de mantenimiento agregado con éxito');

        }

    public function imprimir(Request $request) 
        {
            $IdRegistro = $request->input('IdRegistro');
            $noRegistro = $request->input('noRegistro');
        
            $info = DB::table('tbl_registros')->where('IdRegistro', $IdRegistro)->where('noRegistro', $noRegistro)->first();
            $empresa = DB::table('empresas')->where('id', $info->empresa)->first();
            $planta = DB::table('plantas')->where('id', $info->planta)->first();
        
            // Obtén la ruta del archivo QR
            $qrPath = public_path('qr_codes/' . $noRegistro . '.png');
        
            // Verifica si el archivo QR existe
            if (file_exists($qrPath)) {
                $pdf = \PDF::loadView('pdfQr', compact(['IdRegistro' ,'noRegistro', 'info', 'empresa', 'planta', 'qrPath']));
                
                return $pdf->download('codigoQr.pdf');
            } else {
                // Maneja el caso en que el archivo QR no existe
                return response()->json(['error' => 'El archivo QR no se encontró'], 404);
            }
        }

    public function mmtoPerso()      
        {
            $frecuencia = DB::table('tbl_frecuencias')->get();
            $noparte = DB::table('nopartes')->get();
            $planta = DB::table('plantas')->get();
            return view('mttoPerso',['noparte' => $noparte,'frecuencia' => $frecuencia, 'planta' => $planta ]); 
        }
    
    public function enviarMmtoPerso(Request $Request)      
    {
        //dd($Request);
        $date = Carbon::now();
        $user = auth()->user()->id;
        DB::table('tbl_mttopersonalizado')->insert([
            'nombreMtto' => $Request->nombreMtto,
            'noParte' => $Request->nopartes,
            'planta' => $Request->planta,
            'frecuencia' => $Request->frecuencia,
            'observacion' => $Request->observacion,
            'dateCreation' => $date,
            'userCreation' => $user,
        ]);

        return redirect('irmttoperso');
    }

    public function irmttoperso()
    {
        $registros = DB::table('tbl_mttopersonalizado')->where('planta', auth()->user()->idPlanta)->get();
        return view('regisMtto',['registros' => $registros])->with('mensaje', 'Registros creados con éxito');
    }
    
}
