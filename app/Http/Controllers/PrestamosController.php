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

class prestamoNuevoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamoNuevo= DB::table('estudiantes')
            ->join('prestamoNuevo','estudiantes.id','=','prestamoNuevo.estudiante_id')
            ->join('instrumentos','instrumentos.id','=','prestamoNuevo.instrumento_id')
            ->join('users','users.id','=','prestamoNuevo.user_id')
            ->select('prestamoNuevo.*','estudiantes.nombre_estudiante','estudiantes.apellido_estudiante','estudiantes.numero_documento'
                ,'instrumentos.nombre','users.name','users.apellido')->get();
        
        //-------------instrumentos prestados-----------//
        $osciloscopios=DB::table('instrumentos')
            ->where('estado','ocupado')->where('nombre','LIKE','O%')->count();

        $bananas=DB::table('instrumentos')
            ->where('estado','ocupado')->where('tipo','Caiman')->count();

        $multimetros=DB::table('instrumentos')
            ->where('estado','ocupado')->where('nombre','LIKE','M%')->count();


        return view('admin/prestamoNuevo/index')->with('prestamoNuevo',$prestamoNuevo)->with('osciloscopios',$osciloscopios)
            ->with('bananas',$bananas)->with('multimetros',$multimetros);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/prestamoNuevo/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for ($i=0; $i < sizeof($request->prestamo_paquetes); $i++){

            $prestamoNuevo = new Prestamo();
            $user= User::where('id','=',$request->usuario_id);
            $estudiante = Estudiante::where('id','=',$request->estudiante_id);
            $instrumento = Instrumento::where('nombre' . ' ' . 'tipo','=',$request->prestamo_equipos[$i])->get();
            $instrumento->cantidad= $instrumento->cantidad-$request->cantidad_del_equipo[$i];

            $prestamoNuevo->user_id=$user->id;
            $prestamoNuevo->estudiante_id=$request->$estudiante->id;
            $prestamoNuevo->equipo_id=$instrumento->id;
            $prestamoNuevo->componente_id=null;
            $prestamoNuevo->cantidad_equipo=$request->cantidad_del_equipo[$i];
            $prestamoNuevo->cantidad_componente=0;
            $prestamoNuevo->estado="ACTIVO";
            $prestamoNuevo->observaciones=$request->observaciones;

            $prestamoNuevo->save();
        }


        for ($i=0; $i < sizeof($request->prestamo_equipos); $i++){

            if ($cantidad_del_equipo[$i]!=0){
                $prestamoNuevo = new Prestamo();
                $user= User::where('id','=',$request->usuario_id);
                $estudiante = Estudiante::where('id','=',$request->estudiante_id);

                if(substr($request->prestamo_paquetes[$i],0,1) == 'O'){

                }

            }
        }

        for ($i=0; $i < sizeof($request->prestamo_componentes); $i++){

            if ($cantidad_del_componente[$i]!=0){
                $prestamoNuevo = new Prestamo();
                $user= User::where('id','=',$request->usuario_id);
                $estudiante = Estudiante::where('id','=',$request->estudiante_id);
                $componente = Componente::where('nombre' . ' ' . 'referencia','=',$request->prestamo_componentes[$i])->get();
                $componente->cantidad= $componente->cantidad-$request->cantidad_del_componente[$i];

                $prestamoNuevo->user_id=$user->id;
                $prestamoNuevo->estudiante_id=$request->$estudiante->id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_del_componente[$i];
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones=$request->observaciones;

                $prestamoNuevo->save();
            }
        }

        return redirect()->route('admin.prestamos.index');


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
       $prestamoNuevo=Prestamo::find($id);
       $instrumento=Instrumento::find($prestamoNuevo->instrumento_id);
       $instrumento->estado="disponible";
       $instrumento->save();
       $prestamoNuevo->delete();
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
