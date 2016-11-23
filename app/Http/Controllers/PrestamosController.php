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
                ,'componentes.nombre AS nombre_componente','componentes.referencia AS referencia_componente','componentes.cantidad AS cantidad_compo'
                ,'users.name','users.apellido')->get();

        $paquetesPrestados= DB::table('estudiantes')
            ->join('prestamos','estudiantes.id','=','prestamos.estudiante_id')
            ->join('users','users.id','=','prestamos.user_id')
            ->select('prestamos.*','estudiantes.nombre_estudiante','estudiantes.apellido_estudiante','estudiantes.numero_documento'
                ,'users.name','users.apellido')->get();

        //-------------encontrar la cantidad de osciloscopios prestados-----------//
        $osciloscopios=DB::table('prestamos')
            ->join('instrumentos','prestamos.equipo_id','=','instrumentos.id')
            ->where('prestamos.estado','ACTIVO')->where('instrumentos.nombre','LIKE','OSCI%')->sum('prestamos.cantidad_equipo');

        //-------------encontrar la cantidad de generadores prestados-----------//
        $generadores=DB::table('prestamos')
            ->join('instrumentos','prestamos.equipo_id','=','instrumentos.id')
            ->where('prestamos.estado','ACTIVO')->where('instrumentos.nombre','LIKE','GENE%')->sum('prestamos.cantidad_equipo');

        //-------------encontrar la cantidad de fuentes prestadas-----------//
        $fuentes=DB::table('prestamos')
            ->join('instrumentos','prestamos.equipo_id','=','instrumentos.id')
            ->where('prestamos.estado','ACTIVO')->where('instrumentos.nombre','LIKE','FUEN%')->sum('prestamos.cantidad_equipo');

        //-------------encontrar la cantidad de multimetros prestados-----------//
        $multimetros=DB::table('prestamos')
            ->join('instrumentos','prestamos.equipo_id','=','instrumentos.id')
            ->where('prestamos.estado','ACTIVO')->where('instrumentos.nombre','LIKE','MULT%')->sum('prestamos.cantidad_equipo');

        return view('admin/prestamos/index')->with('prestamosEquipos',$equiposPrestados)->with('prestamosComponentes',$componentesPrestados)->with('prestamosPaquetes',$paquetesPrestados)->with('osciloscopios',$osciloscopios)
            ->with('generadores',$generadores)->with('fuentes',$fuentes)->with('multimetros',$multimetros);
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
/*
* El siguiente metodo es para agregar los paquetes como un prestamo individual
*/
        if($request->prestamo_paquetes != ''){
            if(strlen($request->prestamo_paquetes) == 3){
                if(Instrumento::where('nombre','=','OSCILOSCOPIO')->get() != null){
                    $prestamoNuevo = new Prestamo();
                    $instrumentos = Instrumento::where('nombre','=','OSCILOSCOPIO')->get();
                    if(sizeof($instrumentos) !=0){
                        $contador=0;
                        foreach ($instrumentos as $instrumento) {
                            if($contador < 2){
                                $resta = $instrumento->cantidad - 1;
                                $instrumento->cantidad = $resta;
                                $prestamoNuevo->user_id=$request->usuario_id;
                                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                $prestamoNuevo->equipo_id=$instrumento->id;
                                $prestamoNuevo->componente_id=null;
                                $prestamoNuevo->cantidad_equipo=1;
                                $prestamoNuevo->cantidad_componente=0;
                                $prestamoNuevo->estado="ACTIVO";
                                $prestamoNuevo->observaciones=$request->observaciones;
                                $contador = $contador + 1;
                                $instrumento->save();
                            }
                        }
                        $prestamoNuevo->save();
                    }
                }
                if(Instrumento::where('nombre','=','GENERADOR')->get() != null){
                    $prestamoNuevo = new Prestamo();
                    $instrumentos = Instrumento::where('nombre','=','GENERADOR')->get();
                    if(sizeof($instrumentos) !=0){
                        $contador=0;

                        foreach ($instrumentos as $instrumento) {
                            if($contador < 2){
                                $resta = $instrumento->cantidad - 1;
                                $instrumento->cantidad = $resta;
                                $prestamoNuevo->user_id=$request->usuario_id;
                                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                $prestamoNuevo->equipo_id=$instrumento->id;
                                $prestamoNuevo->componente_id=null;
                                $prestamoNuevo->cantidad_equipo=1;
                                $prestamoNuevo->cantidad_componente=0;
                                $prestamoNuevo->estado="ACTIVO";
                                $prestamoNuevo->observaciones=$request->observaciones;
                                $contador = $contador + 1;
                                $instrumento->save();
                            }   
                        }

                        $prestamoNuevo->save();
                    }
                }
                if(Instrumento::where('nombre','=','FUENTE')->get() != null){
                    $prestamoNuevo = new Prestamo();
                    $instrumentos = Instrumento::where('nombre','=','FUENTE')->get();
                    if(sizeof($instrumentos) !=0){
                        dd("entre y es nulo");
                        $contador=0;
                        foreach ($instrumentos as $instrumento) {
                            if($contador < 2){
                                $resta = $instrumento->cantidad - 1;
                                $instrumento->cantidad = $resta;
                                $prestamoNuevo->user_id=$request->usuario_id;
                                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                $prestamoNuevo->equipo_id=$instrumento->id;
                                $prestamoNuevo->componente_id=null;
                                $prestamoNuevo->cantidad_equipo=1;
                                $prestamoNuevo->cantidad_componente=0;
                                $prestamoNuevo->estado="ACTIVO";
                                $prestamoNuevo->observaciones=$request->observaciones;
                                $contador = $contador + 1;
                                $instrumento->save();
                            }
                        }

                        $prestamoNuevo->save();
                    }
                }

            }else{

            }

        }

/*
* El siguiente metodo es para agregar solo los equipos como un prestamo individual como un prestamo individual
*/
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
/*
* El siguiente metodo es para agregar solo los componentes como un prestamos individuales
*/
        for ($i=0; $i < sizeof($request->prestamo_componentes); $i++){

            if ($request->cantidad_del_componente[$i]!=0){
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
/*
* El siguiente metodo es para agregar las resistencias en OHMIOS como un prestamo individual
*/
        if ($request->cantidad_de_la_resistencia_ohmios!=0){
            $prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_ohmios . ' ' . 'Ω')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_de_la_resistencia_ohmios;
                $componente->cantidad= $resta;

                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_de_la_resistencia_ohmios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones=$request->observaciones;
                
                $componente->save();
            }
        $prestamoNuevo->save();
        }
/*
* El siguiente metodo es para agregar las resistencias en KILO_OHMIOS como un prestamo individual
*/
        if ($request->cantidad_de_la_resistencia_kiloohmios!=0){
            $prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_kiloohmios . ' ' . 'KΩ')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_de_la_resistencia_kiloohmios;
                $componente->cantidad= $resta;

                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_de_la_resistencia_kiloohmios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones=$request->observaciones;
                
                $componente->save();
            }
        $prestamoNuevo->save();
        }
/*
* El siguiente metodo es para agregar las resistencias en MEGA_OHMIOS como un prestamo individual
*/
        if ($request->cantidad_de_la_resistencia_megaohmios!=0){
            $prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_megaohmios . ' ' . 'MΩ')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_de_la_resistencia_megaohmios;
                $componente->cantidad= $resta;

                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_de_la_resistencia_megaohmios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones=$request->observaciones;
                
                $componente->save();
            }
        $prestamoNuevo->save();
        }
/*
* El siguiente metodo es para agregar los CONDENSADORES en NANO_FARADIOS como un prestamo individual
*/
        if ($request->cantidad_de_la_condensadores_nanofaradios!=0){
            $prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_nanofaradios . ' ' . 'nF')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_de_la_condensadores_nanofaradios;
                $componente->cantidad= $resta;

                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_de_la_condensadores_nanofaradios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones=$request->observaciones;
                
                $componente->save();
            }
        $prestamoNuevo->save();
        }

/*
* El siguiente metodo es para agregar los CONDENSADORES en PICO_FARADIOS como un prestamo individual
*/
        if ($request->cantidad_del_condensador_picofaradios!=0){
            $prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_picofaradios . ' ' . 'pF')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_del_condensador_picofaradios;
                $componente->cantidad= $resta;

                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_del_condensador_picofaradios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones=$request->observaciones;
                
                $componente->save();
            }
        $prestamoNuevo->save();
        }

/*
* El siguiente metodo es para agregar los CONDENSADORES en PICO_FARADIOS como un prestamo individual
*/
        if ($request->cantidad_del_condensador_microfaradios!=0){
            $prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_microfaradios . ' ' . 'uF')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_del_condensador_microfaradios;
                $componente->cantidad= $resta;

                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_del_condensador_microfaradios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones=$request->observaciones;
                
                $componente->save();
            }
        $prestamoNuevo->save();
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
            $instrumento=Instrumento::find($prestamos->equipo_id);
            $suma = $prestamos->cantidad_equipo +  $instrumento->cantidad;
            $instrumento->cantidad=$suma;
            $instrumento->save(); 

            $prestamos->estado="INACTIVO";
            $prestamos->save();
       }
       elseif ($prestamos->componente_id != null) {
            $componente = Componente::find($prestamos->componente_id);       
            $suma = $prestamos->cantidad_componente +  $componente->cantidad;
            $componente->cantidad=$suma;
            $componente->save();

            $prestamos->estado="INACTIVO";
            $prestamos->save();
       }
       elseif($prestamos->paquetes != ""){
            $prestamos->estado="INACTIVO";
            $prestamos->save();
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
