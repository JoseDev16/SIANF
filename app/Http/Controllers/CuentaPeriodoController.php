<?php

namespace App\Http\Controllers;

use App\Models\CuentaPeriodo;
use App\Models\Periodo;
use App\Models\Empresa;
use App\Models\EstadoResultado;
use App\Models\BalanceGeneral;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CuentaPeriodoImport;
use App\Imports\CuentasImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CuentaPeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$empresa_id = 1;
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','asc')->get();

        return \view('cuentaperiodo.index',compact('periodos'));
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
        //
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        //validando para evitar que se registre dos veces el mismo periodo
        $validacion = DB::table('cuenta_periodos')->where('periodo_id', '=', $request->periodo_id)->get();
        if(count($validacion) == 0){
            $file = $request->file('file');
            Excel::import(new CuentaPeriodoImport, $file);

            $cuentasPeriodo = DB::table('cuenta_periodos')->whereNull('periodo_id')->get();
            foreach($cuentasPeriodo as $cuentaPeriodo){
                $cuenta = CuentaPeriodo::find($cuentaPeriodo->id);
                $cuenta->periodo_id = $request->periodo_id;
                $cuenta->save();
            }

            $estadoResultados = new EstadoResultado();
            $balanceGeneral = new BalanceGeneral();
            $estadoResultados->periodo_id = $request->periodo_id;
            $balanceGeneral->periodo_id = $request->periodo_id;

            foreach($cuentasPeriodo as $cuentaPeriodo){
                $cuenta = CuentaPeriodo::find($cuentaPeriodo->id);
                
                switch($cuenta->cuenta_id){
                    case 1: 
                        $balanceGeneral->activos = $cuentaPeriodo->total;
                        break;
                    
                    case 2: 
                        $balanceGeneral->activo_corriente = $cuentaPeriodo->total;
                        break;
                    
                    case 3: 
                        $balanceGeneral->efectivo = $cuentaPeriodo->total;
                        break;

                    case 4: 
                        $balanceGeneral->cuentas_por_cobrar = $cuentaPeriodo->total;
                    break;

                    case 5: 
                        $balanceGeneral->inventario = $cuentaPeriodo->total;
                    break;

                    case 6: 
                        $balanceGeneral->activo_no_corriente = $cuentaPeriodo->total;
                    break;

                    case 7: 
                        $balanceGeneral->activo_fijo_neto = $cuentaPeriodo->total;
                    break;

                    case 8: 
                        $balanceGeneral->pasivos = $cuentaPeriodo->total;
                    break;

                    case 9: 
                        $balanceGeneral->pasivo_corriente = $cuentaPeriodo->total;
                    break;

                    case 10: 
                        $balanceGeneral->cuentas_por_pagar = $cuentaPeriodo->total;
                    break;

                    case 11: 
                        $balanceGeneral->pasivo_no_corriente = $cuentaPeriodo->total;
                    break;

                    case 12: 
                        $balanceGeneral->patrimonio = $cuentaPeriodo->total;
                    break;

                    case 13: 
                        $balanceGeneral->capital_social = $cuentaPeriodo->total;
                    break;

                    case 14: 
                        $estadoResultados->ventas_netas = $cuentaPeriodo->total;
                    break;

                    case 15: 
                        $estadoResultados->costo_ventas = $cuentaPeriodo->total;
                    break;

                    case 16: 
                        $estadoResultados->utilidad_bruta = $cuentaPeriodo->total;
                    break;

                    case 17: 
                        $estadoResultados->gastos_ventas = $cuentaPeriodo->total;
                    break;

                    case 18: 
                        $estadoResultados->gastos_administracion = $cuentaPeriodo->total;
                    break;

                    case 19: 
                        $estadoResultados->utilidad_operativa = $cuentaPeriodo->total;
                    break;

                    case 20: 
                        $estadoResultados->gastos_financieros = $cuentaPeriodo->total;
                    break;

                    case 21: 
                        $estadoResultados->utilidad_antes_de_i = $cuentaPeriodo->total;
                    break;

                    case 22: 
                        $estadoResultados->intereses = $cuentaPeriodo->total;
                    break;

                    case 23: 
                        $estadoResultados->impuestos = $cuentaPeriodo->total;
                    break;

                    case 24: 
                        $estadoResultados->utilidad_neta = $cuentaPeriodo->total;
                    break;
                }
            }

            $balanceGeneral->save();
            $estadoResultados->save();

            return back()->with('exito', 'Importacion exitosa');

        } else {
            return back()->with('exito', 'Ya se realizó la importación previamente');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuentaPeriodo  $cuentaPeriodo
     * @return \Illuminate\Http\Response
     */
    public function show(CuentaPeriodo $cuentaPeriodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuentaPeriodo  $cuentaPeriodo
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaPeriodo $cuentaPeriodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuentaPeriodo  $cuentaPeriodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuentaPeriodo $cuentaPeriodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuentaPeriodo  $cuentaPeriodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentaPeriodo $cuentaPeriodo)
    {
        //
    }
}
