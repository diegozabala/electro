<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipo;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;



class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = Equipo::orderBy('nombre','asc')->paginate(10);
       
        return view ('admin/equipos/index')  -> with('equipos',$equipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.equipos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipos = new Equipo($request->all());
        $equipos->nombre = $request->nombre;
        $equipos->placa = $request->placa;
        $equipos->descripcion = $request->descripcion;
        $equipos->tipo=$request->tipo;
        $equipos->estado="disponible";
        $equipos->save();
        return redirect()->route ('admin.equipos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipo=Equipo::find($id);
        return view('admin.equipos.show')->with('equipo',$equipo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipo=Equipo::find($id);
        return view('admin.equipos.edit')->with('equipos',$equipo);
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
        $equipos = Equipo::find($id);
        $equipos->nombre = $request->nombre;
        $equipos->placa = $request->placa;
        $equipos->descripcion = $request->descripcion;
       
        $equipos->estado="disponible";
        $equipos->save();
        return redirect()->route ('admin.equipos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = Equipo::find($id);
        $equipo -> delete();
        return redirect(route('admin.equipos.index'));
    }
}
