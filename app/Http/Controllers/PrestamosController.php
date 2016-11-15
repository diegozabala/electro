<?php

namespace App\Http\Controllers;

use App\Instrumento;
use App\Componente;
use App\Estudiante;
use App\Prestamo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Collective\Annotations\Database;

class PrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamos= DB::table('estudiantes')
            ->join('prestamos','estudiantes.id','=','prestamos.estudiante_id')
            ->join('instrumentos','instrumentos.id','=','prestamos.instrumento_id')
            ->join('users','users.id','=','prestamos.user_id')
            ->select('prestamos.*','estudiantes.nombre_estudiante','estudiantes.apellido_estudiante','estudiantes.numero_documento'
                ,'instrumentos.nombre','users.name','users.apellido')->get();
        
        //-------------instrumentos prestados-----------//
        $osciloscopios=DB::table('instrumentos')
            ->where('estado','ocupado')->where('nombre','LIKE','O%')->count();

        $bananas=DB::table('instrumentos')
            ->where('estado','ocupado')->where('tipo','Caiman')->count();

        $multimetros=DB::table('instrumentos')
            ->where('estado','ocupado')->where('nombre','LIKE','M%')->count();


        return view('admin/prestamos/index')->with('prestamos',$prestamos)->with('osciloscopios',$osciloscopios)
            ->with('bananas',$bananas)->with('multimetros',$multimetros);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/prestamos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request->$equipos_seleccionados);

/*
        $instrumento = new Instrumento();
        $prestamos = new Prestamo();
        $nombres = $request->prestamos;
        $adicion=$request->adicion;
        $tamaño2=sizeof($adicion);
        $var="";
        for ($i=0;$i < $tamaño2;$i++){
            if ($i < $tamaño2-1 )
            $var.=$adicion[$i]."+";

            else
                $var.=$adicion[$i];

        }

        $tamaño=sizeof($nombres);
        $instrumento1= new Instrumento();
        $user= User::where('nombre','=',$request->nombre);
        for ($i=0; $i < $tamaño; $i++){
            if ($tamaño==1){
                $prestamos = new Prestamo();
                $instrumento = Instrumento::where('nombre','=',$nombres[$i])->get();
                $instrumento1= $instrumento[0];
                if ($instrumento1->tipo=="EX"){
                    $instrumento1->estado="disponible";
                }
                else{
                    $instrumento1 ->estado="ocupado";
                }


                $prestamos->adicion=$var;
                $prestamos->instrumento_id=$instrumento[0]["id"];
                $prestamos->observaciones=$request->observaciones;
                $prestamos->estudiante_id=$request->codigo;
                $prestamos->user_id=$request->nombre;
                $instrumento1->save();
                $prestamos->save();
                $prestamos=null;
                $instrumento=null;
                $instrumento1=null;
            }
            else{
                $prestamos = new Prestamo();
                $instrumento = Instrumento::where('nombre','=',$nombres[$i])->get();
                $instrumento1= $instrumento[0];
                if ($instrumento->tipo=="EX"){
                    $instrumento->estado="disponible";
                }
                else{
                    $instrumento1->estado="ocupado";
                }
                $prestamos->adicion=$var;
                $prestamos->instrumento_id=$instrumento[0]["id"];
                $prestamos->observaciones=$request->observaciones;
                $prestamos->estudiante_id=$request->codigo;
                $prestamos->user_id=$request->nombre;
                $instrumento1->save();
                $prestamos->save();
                $prestamos=null;
                $instrumento=null;
                $instrumento1=null;
                $var="";
            }
            
        }
        return redirect()->route('admin.prestamos.index');
*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestamo=Prestamo::find($id);
        $estudiante = Estudiante::find($prestamo->estudiante_id);
        return view('admin/prestamos/edit')->with('prestamo',$prestamo)->with('estudiante',$estudiante);
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
        $prestamo=Prestamo::find($id);
        $adicion=$request->adicion;
        $tamaño2=sizeof($adicion);
        $var="";
        for ($i=0;$i < $tamaño2;$i++){
            if ($i < $tamaño2-1 )
                $var.=$adicion[$i]."+";

            else
                $var.=$adicion[$i];

        }

        $prestamo->adicion=$var;
        $prestamo->observaciones=$request->observaciones;

        $prestamo->save();

        return redirect()->route('admin.prestamos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id){
       $prestamos=Prestamo::find($id);
       $instrumento=Instrumento::find($prestamos->instrumento_id);
       $instrumento->estado="disponible";
       $instrumento->save();
       $prestamos->delete();
       return redirect()->route('admin.prestamos.index');

   }

    public function find(Request $request){
        $nombre=$request->codigo;

            $instrumentos = Instrumento::where('estado', '=', 'disponible')->orderBy('nombre', 'asc')->get();
            $componentes = Componente::where('estado', '=', 'disponible')->orderBy('nombre', 'asc')->get();
            $estudiante = Estudiante::where('numero_documento', '=', $nombre)->get();
        if (count($estudiante)==0){
            return view('errors.503');
            }
        return view('admin/prestamos/find')->with('estudiante',$estudiante)->with('instrumentos',$instrumentos)->with('componentes',$componentes);


        

    }
    public function find1(Request $request){
        $nombre=$request->nombre;

        $instrumentos = Instrumento::where('estado', '=', 'disponible')->orderBy('nombre', 'asc')->get();
        $estudiante = Estudiante::where('nombre_estudiante', 'LIKE', '%'.$nombre.'%')->get();
        if (count($estudiante)==0){
            return view('errors.503');
        }
        elseif (count($estudiante)>1){
            
            
            return view('admin/prestamos/profes')->with('estudiante',$estudiante);
        }

        return view('admin/prestamos/find')->with('estudiante',$estudiante)->with('instrumentos',$instrumentos);

    }
    
}
