<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\CuentaPeriodo;
use App\Models\Empresa;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnalisisVerticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->paginate(5);

        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->paginate(5);

        $año = 0;
        if($request->periodo_id==null){
            $periodo_id = Periodo::join('cuenta_periodos','cuenta_periodos.periodo_id','=','periodos.id')
            ->where('empresa_id', '=', $empresa->id)->max('cuenta_periodos.periodo_id');
            $periodo = Periodo::find($periodo_id);
            $año = $periodo->year;
        } else {
            $periodo = Periodo::find($request->periodo_id);
            $periodo_id = $periodo->id;
            $año = $periodo->year;
        }

        $balancegeneral = CuentaPeriodo::join('cuentas', 'cuentas.id', '=', 'cuenta_periodos.cuenta_id')
        ->where('periodo_id', '=', $periodo_id)
        ->where(function($query){
            $query->where('cuentas.tipo_id', '=', 1)
            ->orWhere('cuentas.tipo_id', '=', 2)
            ->orWhere('cuentas.tipo_id', '=', 3);
        })
        ->get();

        // $analisisH = array_merge($balanceAnterior,$balancegeneral);

        $estadoresultados = CuentaPeriodo::join('cuentas', 'cuentas.id', '=', 'cuenta_periodos.cuenta_id')
        ->where('periodo_id', '=', $periodo_id)
        ->where(function($query){
            $query->where('cuentas.tipo_id', '=', 4)
            ->orWhere('cuentas.tipo_id', '=', 5)
            ->orWhere('cuentas.tipo_id', '=', 6);
        })
        ->get();

        // for($i=1; $i<count($balancegeneral); $i++){

        //     $valor = strval($i);
            
        //     $Padre=DB::table('cuentas')
        //     // ->select('cuentas.nombre',' cuentas.codigo')
        //     ->join('cuenta_periodos', 'cuenta_periodos.cuenta_id', '=', 'cuentas.id')
        //     ->join('empresas', 'cuentas.empresa_id', '=', 'empresas.id')
        //     ->where('cuentas.codigo', '=',1)
        //     ->get();
        //     // ->where('cuentas.codigo', '=', strval($i))
            
        //     // dd(strval($i));
        // }
        // // dd($valor);
            
        // dd($Padre);
        

        // dd($balancegeneral);
        // $prueba = Str::startsWith($balancegeneral->codigo,'1.');

        // dd($prueba);
        
        //$tiposParametro = TipoParametros::orderBy('id','asc')->get();
        // return \view('analisisHorizontal.index',compact('periodos', 'año', 'balancegeneral', 'estadoresultados', 
        // 'balanceAnterior', 'estadoAnterior'));

        

        return view('analisisVertical.index', compact('periodos','año','estadoresultados','balancegeneral'));
        

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_periodo)
    {
        //
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();
        if(!$periodo = Periodo::Where('id', $id_periodo)->Where('empresa_id', $empresa->id)->first())
            abort(503);

        $periodos=Periodo::Where('empresa_id', $empresa->id)->get();

        // $activo=DB::table('cuentas')
        // ->join('')
        
        // $periodos=Periodo::Where('empresa_id',$empresa->id)->get();
        // //Traer las vincuncalicones de Activo, pasivo y capital
        // $activo=DB::select('select c.*, cp.total from (select * from cuenta 
        // where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
        // and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        // left join (select * from cuenta_periodo where periodo_id=?) as cp
        // on c.id= cp.cuenta_id',[$empresa->id, 'Activos', $id_periodo]);

        // $pasivo=DB::select('select c.*, cp.total from (select * from cuenta 
        // where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
        // and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        // left join (select * from cuenta_periodo where periodo_id=?) as cp
        // on c.id= cp.cuenta_id',[$empresa->id, 'Pasivos', $id_periodo]);

        // $capital=DB::select('select c.*, cp.total from (select * from cuenta 
        // where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
        // and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        // left join (select * from cuenta_periodo where periodo_id=?) as cp
        // on c.id= cp.cuenta_id',[$empresa->id, 'Patrimonio', $id_periodo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
