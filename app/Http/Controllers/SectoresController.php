<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Actividad;
use Illuminate\Http\Request;

class SectoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Index of Cuenta
        $sectores = Sector::orderBy('id')->paginate(5);
        return \view('sectores.index',compact('sectores'));
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
        Sector::create($request->all());
        $logs = new Actividad();
        $logs->log($request->user,'crear el sector: '.$request->nombre);
        return back()->with('exito','El Sector ha sido agregado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $sector = Sector::find($id);
            return response()->json($sector);
        }
    }

    public function edit(Request $request)
    {
        //
        $id = $request->edit_id;
        $sector = Sector::find($id);

        if (empty($id)) {
            return back();
        }
        $sector->nombre = $request->nombre;
        $sector->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito el sector '.$request->nombre);
        return back()->with('exito','El sector ha sido actualizado exitosamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sector $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $sector = Sector::find($request->delete_id);
        $logs = new Actividad();
        $logs->log($request->user,'elimino el sector '.$sector->nombre);
        $sector->delete();
        return back()->with('exito','El sector ha sido eliminado exitosamente');
    }
}
