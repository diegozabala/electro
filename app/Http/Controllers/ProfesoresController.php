<?php
namespace App\Http\Controllers;

use App\Facultad;
use Illuminate\Http\Request;
use App\Profesor;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;




class ProfesoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $profesores =DB::table('profesores')->join('facultades','profesores.facultad_id','=','facultades.id')
            ->select('profesores.*','facultades.nombre')->
            orderBy('nombre_profesor','asc')->get();

        return view ('admin/profesores/index') -> with ('profesores',$profesores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programas = Facultad::all();
        return view('admin.profesores.create')->with('programas',$programas);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('imagen')){
            $programa=DB::table('facultades')->where('nombre',"=",$request->programa)->get();
            $file=$request->file('imagen');
            $name= 'profesor_'.time(). ".".$file->getClientOriginalExtension();
            $path=public_path()."/images/profesores/";
            $file->move($path,$name);
            
            $profesores= new Profesor();
            $profesores->imagen=$name;
            $profesores->numero=$request->numero;
            $profesores->nombre_profesor  = ucwords(strtolower($request->nombre));
            $profesores->apellido_profesor     = ucwords(strtolower($request->apellido));
            $profesores->cedula = ucwords(strtolower($request->cedula));
            $profesores->facultad_id = ucwords(strtolower($programa[0]->id));
            
            $profesores->save();
            return redirect()->route ('admin.profesores.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profe =DB::table('profesores')->join('facultades','profesores.facultad_id','=','facultades.id')
            ->where('profesores.id','=',$id)
            ->select('profesores.*','facultades.nombre')
            ->get();
        return view('admin.profesores.show')->with('profe',$profe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programas=Facultad::all();
        $profesores=Profesor::find($id);
        return view('admin.profesores.edit')->with('profesor',$profesores)->with('programas',$programas);

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


        if ($request->file('imagen')) {
            $profesor = Profesor::find($id);
            $file=$request->file('imagen');
            $name= 'profesor_'.time(). ".".$file->getClientOriginalExtension();
            $path=public_path()."/images/profesores/";
            $file->move($path,$name);
            $profesor->nombre_profesor = $request->nombre;
            $profesor->apellido_profesor = $request->apellido;
            $profesor->numero = $request->numero;
            $profesor->cedula = $request->cedula;
            $profesor->imagen=$name;

            $profesor->save();
            return redirect()->route('admin.profesores.index');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesor = Profesor::find($id);
        $profesor -> delete();
        return redirect(route('admin.profesores.index'));
    }
    public function find(Request $request){
        dd($request->buscar);
        /*
        $profesores =DB::table('profesores')->join('facultades','profesores.facultad_id','=','facultades.id')
            ->where('profesores.nombre_profesor','LIKE','%'.$request->buscar.'%')
            ->select('profesores.*','facultades.nombre')->
            orderBy('nombre_profesor','asc')->paginate(10);


        return view ('admin/profesores/index') -> with ('profesores',$profesores);
        */
    }
    
}