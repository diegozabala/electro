<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instrumento;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;



class InstrumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instrumentos = Instrumento::orderBy('nombre','asc')->paginate(10);
       
        return view ('admin/instrumentos/index')  -> with('instrumentos',$instrumentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instrumentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instrumentos = new Instrumento($request->all());
        $instrumentos->nombre = $request->nombre;
        $instrumentos->cantidad = $request->cantidad;
        $instrumentos->descripcion = $request->descripcion;
        $instrumentos->tipo=$request->tipo;
        $instrumentos->estado="disponible";
        $instrumentos->save();
        return redirect()->route ('admin.instrumentos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instrumento=Instrumento::find($id);
        return view('admin.instrumentos.show')->with('instrumento',$instrumento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instrumento=Instrumento::find($id);
        return view('admin.instrumentos.edit')->with('instrumentos',$instrumento);
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
        $instrumentos = Instrumento::find($id);
        $instrumentos->nombre = $request->nombre;
        $instrumentos->cantidad = $request->cantidad;
        $instrumentos->descripcion = $request->descripcion;
        $instrumentos->estado="disponible";
        $instrumentos->save();
        return redirect()->route ('admin.instrumentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instrumento = Instrumento::find($id);
        $instrumento -> delete();
        return redirect(route('admin.instrumentos.index'));
    }
}
