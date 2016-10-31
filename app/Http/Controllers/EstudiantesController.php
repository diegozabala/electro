<?php
namespace App\Http\Controllers;

use App\Facultad;
use Illuminate\Http\Request;
use App\Profesor;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;




class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $estudiantes =DB::table('estudiantes')->join('carreras','estudiantes.carrera_id','=','carreras.id')
            ->select('estudiantes.*','carreras.nombre')->
            orderBy('nombre_estudiante','asc')->get();

        return view ('admin/estudiantes/index') -> with ('estudiantes',$estudiantes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carreras::all();
        return view('admin.estudiantes.create')->with('carreras',$carreras);

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
            $carrera=DB::table('carreras')->where('nombre',"=",$request->carrera)->get();
            $file=$request->file('imagen');
            $name= 'estudiante_'.time(). ".".$file->getClientOriginalExtension();
            $path=public_path()."/images/estudiantes/";
            $file->move($path,$name);
            
            $estudiantes= new Estudiante();
            $estudiantes->imagen=$name;
            $estudiantes->numero_documento=$request->numero_documento;
            $estudiantes->nombre_estudiante = ucwords(strtolower($request->nombre_estudiante));
            $estudiantes->apellido_estudiante = ucwords(strtolower($request->apellido_estudiante));
            $estudiantes->carrera_id = ucwords(strtolower($carrera[0]->id));
            
            $estudiantes->save();
            return redirect()->route ('admin.estudiantes.index');
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
        $estudiante =DB::table('estudiantes')->join('carreras','estudiantes.carrera_id','=','carreras.id')
            ->where('estudiantes.id','=',$id)
            ->select('estudiantes.*','carreras.nombre')
            ->get();
        return view('admin.estudiantes.show')->with('estudiante',$estudiante);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carreras=Carrera::all();
        $estudiante=Estudiante::find($id);
        return view('admin.estudiantes.edit')->with('estudiante',$estudiantes)->with('carreras',$carreras);

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
            $estudiante = Estudiante::find($id);
            $file=$request->file('imagen');
            $name= 'estudiante_'.time(). ".".$file->getClientOriginalExtension();
            $path=public_path()."/images/estudiantes/";
            $file->move($path,$name);
            $estudiante->nombre_estudiante = $request->nombre_estudiante;
            $estudiante->apellido_estudiante = $request->apellido_estudiante;
            $estudiante->numero_documento = $request->numero_documento;
            $estudiante->imagen=$name;

            $estudiante->save();
            return redirect()->route('admin.estudiantes.index');
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
        $estudiante = Estudiante::find($id);
        $estudiante -> delete();
        return redirect(route('admin.estudiantes.index'));
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