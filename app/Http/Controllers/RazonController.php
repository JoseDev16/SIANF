<?php

namespace App\Http\Controllers;

use App\Models\Razon;
use App\Models\Empresa;
use App\Models\Periodo;
use App\Models\BalanceGeneral;
use App\Models\EstadoResultado;
use App\Models\Parametros;
use App\Models\PromedioRatios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RazonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->get();
        
        return \view('calculoratios.index',compact('periodos'));
    }

    public function verRazones(Request $request)
    {
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->get();
        $periodo = 0;

        if($request->periodo_id==null){
            $periodo_id = Periodo::join('razons', 'razons.periodo_id', '=', 'periodos.id')
            ->where('empresa_id', '=', $empresa->id)->max('periodos.id');
            $periodo = Periodo::find($periodo_id);
            $año = $periodo->year;
        } else {
            $periodo = Periodo::find($request->periodo_id);
            $periodo_id = $periodo->id;
            $año = $periodo->year;
        }
        
        $ratios = Razon::join('parametros', 'parametros.id', '=', 'razons.parametro_id')->where('periodo_id', '=', $periodo_id)->get();

        return \view('calculoratios.ratios',compact('periodos', 'ratios', 'año'));
    }

    public function verPromedio(Request $request)
    {
        $idUsuario = Auth::id();
        $empresa = Empresa::join('sectors','sectors.id','=','empresas.sector_id')
        ->select('empresas.id as id', 'sectors.id as sector_id', 'sectors.nombre as nombreSector')
        ->where('user_id', '=', $idUsuario)->first();
        $sector = $empresa->nombreSector;
        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->get();
        
        
        if($request->periodo_id==null){
            $año = PromedioRatios::where('sector_id', '=', $empresa->sector_id)->max('year');
        } else {
            $año = $request->periodo_id;
        }

        $ratios = PromedioRatios::join('parametros', 'parametros.id', '=', 'promedio_ratios.parametro_id')
        ->where('sector_id', '=', $empresa->sector_id)
        ->where('year', '=', $año)->get();

        return \view('calculoratios.promedio',compact('periodos','ratios', 'sector','año'));
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
        // Datos del usuario
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        // Obteniendo el periodo actual
        $periodo_act = Periodo::find($request->periodo_id);
        
        // Validacion para evitar calcular otra vez los mismos ratios
        $razones = Razon::where('periodo_id', '=', $periodo_act->id)->first();
        if($razones == null){
            
            // Obteniendo estados actuales
            $balance_act = BalanceGeneral::where('periodo_id', '=', $periodo_act->id)->first();
            $estado_act = EstadoResultado::where('periodo_id', '=', $periodo_act->id)->first();

            if ($balance_act != null){
                // Obteniendo estados del año anterior
                $periodo_ant = Periodo::where('year', '=', ($periodo_act->year)-1)->where('empresa_id', '=', $periodo_act->empresa_id)->first();
                if($periodo_ant!=null){
                    $balance_ant = BalanceGeneral::where('periodo_id', '=', $periodo_ant->id)->first();
                    $estado_ant = EstadoResultado::where('periodo_id', '=', $periodo_ant->id)->first();
                } else {
                    $balance_ant = 0;
                    $estado_ant = 0;
                }

                // Razon circulante
                $razon = Razon::create([  
                    'parametro_id' => 1,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($balance_act->activo_corriente / $balance_act->pasivo_corriente),
                ]);

                // Prueba acida
                $razon = Razon::create([  
                    'parametro_id' => 2,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($balance_act->activo_corriente - $balance_act->inventario) / $balance_act->pasivo_corriente,
                ]);
                
                // Razon de capital de trabajo
                $razon = Razon::create([  
                    'parametro_id' => 3,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($balance_act->activo_corriente - $balance_act->pasivo_corriente) / $balance_act->activos,
                ]);

                // Razon de efectivo
                $razon = Razon::create([  
                    'parametro_id' => 4,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($balance_act->efectivo / $balance_act->pasivo_corriente),
                ]);

                // Razon de rotacion de inventario
                $inventario_prom = $balance_act->inventario;
                if($periodo_ant!=null){
                    $inventario_prom = ($balance_act->inventario + $balance_ant->inventario) / 2;
                }

                $razon = Razon::create([  
                    'parametro_id' => 5,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->costo_ventas) / $inventario_prom,
                ]);

                // Razon de dias de inventario
                $razon = Razon::create([  
                    'parametro_id' => 6,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($inventario_prom / ($estado_act->costo_ventas / 365)),
                ]);

                // Razon de rotacion de cuentas por cobrar 
                $cpc_prom = $balance_act->cuentas_por_cobrar;
                if($periodo_ant!=null){
                    $cpc_prom = ($balance_act->cuentas_por_cobrar + $balance_ant->cuentas_por_cobrar) / 2;
                }

                $razon = Razon::create([  
                    'parametro_id' => 7,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->ventas_netas / $cpc_prom),
                ]);
                
                // Razon de periodo medio de cobranza
                $razon = Razon::create([  
                    'parametro_id' => 8,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($cpc_prom * 365) / $estado_act->ventas_netas,
                ]);

                // Razon de rotacion de cuentas por pagar
                $cpp_prom = $balance_act->cuentas_por_pagar;
                if($periodo_ant!=null){
                    $cpp_prom = ($balance_act->cuentas_por_pagar + $balance_ant->cuentas_por_pagar) / 2;
                }

                $razon = Razon::create([  
                    'parametro_id' => 9,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->costo_ventas / $cpp_prom),
                ]);

                // Periodo medio de pago
                $razon = Razon::create([  
                    'parametro_id' => 10,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($cpp_prom * 365) / $estado_act->costo_ventas,
                ]);

                // Indice de rotacion de activos totales
                $activo_total_prom = $balance_act->activos;
                if($periodo_ant!=null){
                    $activo_total_prom = ($balance_act->activos + $balance_ant->activos) / 2;
                }

                $razon = Razon::create([  
                    'parametro_id' => 11,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->ventas_netas / $activo_total_prom),
                ]);

                // Indice de rotacion de activos fijos
                $activo_fijo_prom = $balance_act->activo_fijo_neto;
                if($periodo_ant!=null){
                    $activo_fijo_prom = ($balance_act->activo_fijo_neto + $balance_ant->activo_fijo_neto) / 2;
                }

                $razon = Razon::create([  
                    'parametro_id' => 12,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->ventas_netas / $activo_fijo_prom),
                ]);
                
                // Indice de margen bruto
                $razon = Razon::create([  
                    'parametro_id' => 13,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->utilidad_bruta / $estado_act->ventas_netas),
                ]);

                // Indice de margen operativa
                $razon = Razon::create([  
                    'parametro_id' => 14,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->utilidad_operativa / $estado_act->ventas_netas),
                ]);

                // Grado de endeudamiento
                $razon = Razon::create([  
                    'parametro_id' => 15,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($balance_act->pasivos / $balance_act->activos),
                ]);

                // Grado de propiedad
                $razon = Razon::create([  
                    'parametro_id' => 16,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($balance_act->patrimonio / $balance_act->activos),
                ]);

                // Razon de endeudamiento
                $razon = Razon::create([  
                    'parametro_id' => 17,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($balance_act->pasivos / $balance_act->patrimonio),
                ]);
                
                // Razon de cobetura de gastos financieros
                $razon = Razon::create([  
                    'parametro_id' => 18,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->utilidad_antes_de_i) / $estado_act->gastos_financieros,
                ]);

                // Rentabilidad neta del patrimonio
                $patrimonio_prom = $balance_act->patrimonio;
                if($periodo_ant!=null){
                    $patrimonio_prom = ($balance_act->patrimonio + $balance_ant->patrimonio) / 2;
                }

                $razon = Razon::create([  
                    'parametro_id' => 19,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->utilidad_neta) / $patrimonio_prom,
                ]);

                // Rentabilidad por accion
                $razon = Razon::create([  
                    'parametro_id' => 20,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->utilidad_neta / $periodo_act->acciones),
                ]);

                // Rentabilidad del activo
                $razon = Razon::create([  
                    'parametro_id' => 21,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->utilidad_neta / $activo_total_prom),
                ]);

                // Rentabilidad sobre ventas
                $razon = Razon::create([  
                    'parametro_id' => 22,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->utilidad_neta / $estado_act->ventas_netas),
                ]);
                
                // Rentabilidad sobre la inversion
                $razon = Razon::create([  
                    'parametro_id' => 23,
                    'periodo_id' => $periodo_act->id,
                    'double' => ($estado_act->ventas_netas - $estado_act->costo_ventas) / $estado_act->costo_ventas,
                ]);


                // Recalculo de promedio empresarial
                // Obteniendo todas las razones financieras para evaluar cada una de ellas
                $razones = Parametros::all();
                foreach($razones as $razon){

                    // Encontrando los calculos de ratios de empresas del mismo sector
                    $ratios = Razon::join('periodos','periodos.id','=','razons.periodo_id')
                    ->join('empresas','empresas.id','=','periodos.empresa_id')
                    ->where('parametro_id', '=', $razon->id)
                    ->where('empresas.sector_id', '=', $empresa->sector_id)
                    ->where('periodos.year', '=', $periodo_act->year)->get();

                    // Calculando el promedio
                    $suma = 0;
                    $cont = 0;
                    $promedio = 0;
                    foreach($ratios as $ratio){
                        $suma += $ratio->double; 
                        $cont++;
                    }
                    $promedio = $suma/$cont;

                    // Guardando el promedio del ratio para un mismo sector
                    $ratio_prom = PromedioRatios::where('parametro_id', '=', $razon->id)
                    ->where('sector_id', '=', $empresa->sector_id)
                    ->where('year', '=', $periodo_act->year)->first();

                    if($ratio_prom == null){
                        $ratio_prom = new PromedioRatios();
                        $ratio_prom->sector_id = $empresa->sector_id;
                        $ratio_prom->parametro_id = $razon->id;
                        $ratio_prom->year = $periodo_act->year;
                    }
                    $ratio_prom->valor_promedio = $promedio;
                    $ratio_prom->save();

                }
                return back()->with('exito','Los ratios se calcularon correctamente');

            } else {
                return back()->with('exito','No se han ingresado datos de este periodo');
            }
            
        } else {
            return back()->with('exito','Ya se calcularon los ratios para este periodo');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Razon  $razon
     * @return \Illuminate\Http\Response
     */
    public function show(Razon $razon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Razon  $razon
     * @return \Illuminate\Http\Response
     */
    public function edit(Razon $razon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Razon  $razon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Razon $razon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Razon  $razon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Razon $razon)
    {
        //
    }
}
