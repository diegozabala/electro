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
        $equiposPrestados= DB::table('estudiantes')
            ->join('prestamos','estudiantes.id','=','prestamos.estudiante_id')
            ->join('instrumentos','instrumentos.id','=','prestamos.equipo_id')
            ->join('users','users.id','=','prestamos.user_id')
            ->select('prestamos.*','estudiantes.nombre_estudiante','estudiantes.apellido_estudiante','estudiantes.numero_documento'
                ,'instrumentos.nombre AS nombre_instrumento','instrumentos.tipo AS tipo_instrumento','instrumentos.cantidad AS cantidad_instrumento'
                ,'users.name','users.apellido')->get();

        $componentesPrestados= DB::table('estudiantes')
            ->join('prestamos','estudiantes.id','=','prestamos.estudiante_id')
            ->join('componentes','componentes.id','=','prestamos.componente_id')
            ->join('users','users.id','=','prestamos.user_id')
            ->select('prestamos.*','estudiantes.nombre_estudiante','estudiantes.apellido_estudiante','estudiantes.numero_documento'
                ,'componentes.nombre AS nombre_componente','componentes.referencia AS referencia_componente','componentes.cantidad AS cantidad_componente'
                ,'users.name','users.apellido')->get();

        $paquetesPrestados= DB::table('estudiantes')
            ->join('prestamos','estudiantes.id','=','prestamos.estudiante_id')
            ->join('users','users.id','=','prestamos.user_id')
            ->select('prestamos.*','estudiantes.nombre_estudiante','estudiantes.apellido_estudiante','estudiantes.numero_documento'
                ,'users.name','users.apellido')->get();
        
        //-------------instrumentos prestados-----------//
        $osciloscopios=DB::table('instrumentos')
            ->where('estado','ocupado')->where('nombre','LIKE','O%')->count();

        $bananas=DB::table('instrumentos')
            ->where('estado','ocupado')->where('tipo','Caiman')->count();

        $multimetros=DB::table('instrumentos')
            ->where('estado','ocupado')->where('nombre','LIKE','M%')->count();


        return view('admin/prestamos/index')->with('prestamosEquipos',$equiposPrestados)->with('prestamosComponentes',$componentesPrestados)->with('prestamosPaquetes',$paquetesPrestados)->with('osciloscopios',$osciloscopios)
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


        if($request->prestamo_paquetes != ''){
            $prestamoNuevo = new Prestamo();
            $prestamoNuevo->user_id=$request->usuario_id;
            $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
            $prestamoNuevo->equipo_id=null;
            $prestamoNuevo->componente_id=null;
            $prestamoNuevo->cantidad_equipo=0;
            $prestamoNuevo->cantidad_componente=0;
            $prestamoNuevo->estado="ACTIVO";
            $prestamoNuevo->observaciones=$request->observaciones;
            $prestamoNuevo->paquetes=$request->prestamo_paquetes;

            $prestamoNuevo->save();
        }

        for ($i=0; $i < sizeof($request->prestamo_equipos); $i++){

            if ($request->cantidad_del_equipo[$i]!=0){
                $prestamoNuevo = new Prestamo();
                $instrumentos = Instrumento::where('id','=',$request->prestamo_equipos[$i])->get();

                foreach ($instrumentos as $instrumento) {
                        $resta = $instrumento->cantidad - $request->cantidad_del_equipo[$i];
                        $instrumento->cantidad = $resta;
                        $prestamoNuevo->user_id=$request->usuario_id;
                        $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                        $prestamoNuevo->equipo_id=$instrumento->id;
                        $prestamoNuevo->componente_id=null;
                        $prestamoNuevo->cantidad_equipo=$request->cantidad_del_equipo[$i];
                        $prestamoNuevo->cantidad_componente=0;
                        $prestamoNuevo->estado="ACTIVO";
                        $prestamoNuevo->observaciones=$request->observaciones;

                    $instrumento->save();
                }
                $prestamoNuevo->save();
            }
        }

        for ($i=0; $i < sizeof($request->prestamo_componentes); $i++){

            if ($request->prestamo_componentes[$i]!=0){
                $prestamoNuevo = new Prestamo();
                $componentes = Componente::where('id','=',$request->prestamo_componentes[$i])->get();

                foreach ($componentes as $componente) {
                    $resta = $componente->cantidad - $request->cantidad_del_componente[$i];
                    $componente->cantidad= $resta;

                    $prestamoNuevo->user_id=$request->usuario_id;
                    $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                    $prestamoNuevo->equipo_id=null;
                    $prestamoNuevo->componente_id=$componente->id;
                    $prestamoNuevo->cantidad_equipo=0;
                    $prestamoNuevo->cantidad_componente=$request->cantidad_del_componente[$i];
                    $prestamoNuevo->estado="ACTIVO";
                    $prestamoNuevo->observaciones=$request->observaciones;
                    
                    $componente->save();
                }
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
       $prestamos=Prestamo::find($id);

        if($prestamos->equipo_id != null){
            $instrumentos=Instrumento::find($prestamos->equipo_id);
                foreach ($instrumentos as $instrumento) {
                    
                    $suma = $prestamos->cantidad_equipo +  $instrumento->cantidad;
                    $instrumento->cantidad=$suma;
                    $instrumento->save();
                }

            $prestamos->estado="NO DISPONIBLE";
       }
       elseif ($prestamos->componente_id != null) {
            $componentes = Componente::find($prestamos->componente_id);
                foreach ($componentes as $componente) {
                    
                    $suma = $prestamos->cantidad_componente +  $componente->cantidad;
                    $componente->cantidad=$suma;
                    $componente->save();
                }

            $prestamos->estado="NO DISPONIBLE";
       }

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
