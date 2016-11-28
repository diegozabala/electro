<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Componente;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;


class ComponentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $componentes = Componente::orderBy('nombre','asc')->paginate(10);
       
        return view ('admin/componentes/index')  -> with('componentes',$componentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.componentes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $componentes = new Componente($request->all());
        $componentes->nombre = strtoupper($request->nombre);
        $componentes->cantidad = $request->cantidad;
        $componentes->descripcion =strtoupper($request->descripcion);
        $componentes->referencia=strtoupper($request->referencia . ' ' . $request->capacidad);
        $componentes->estado=strtoupper("disponible");
        $componentes->save();
        return redirect()->route ('admin.componentes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $componente = Componente::find($id);
        return view('admin.componentes.show')->with('componente',$componente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $componente=Componente::find($id);
        return view('admin.componentes.edit')->with('componente',$componente);
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
        $componentes = Componente::find($id);
        $componentes->nombre = strtoupper($request->nombre);
        $componentes->cantidad = $request->cantidad;
        $componentes->descripcion = strtoupper($request->descripcion);
        $componentes->referencia = strtoupper($request->referencia);
        $componentes->estado=strtoupper("disponible");
        $componentes->save();
        return redirect()->route ('admin.componentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $componente = Componente::find($id);
        $componente -> delete();
        return redirect(route('admin.componentes.index'));
    }
}
