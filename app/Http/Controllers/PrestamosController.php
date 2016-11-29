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
                    ->join('users','users.id','=','prestamos.user_id')
                    ->select('prestamos.*','estudiantes.nombre_estudiante','estudiantes.apellido_estudiante','estudiantes.numero_documento','users.name','users.apellido')->get();

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
            ->with('generadores',$generadores)->with('fuentes',$fuentes)->with('multimetros',$multimetros)->with('prestamos',$prestamos);
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
        $prestamoNuevo = new Prestamo();
        $cosasPrestadas = "Se presto: " . "==>";
/*
* El siguiente metodo es para agregar los paquetes como un prestamo individual
*/
        if($request->prestamo_paquetes != ''){
            // Se lee el tamaño de letras que tiene el paquete seleccionado y caso de ser 3 entra aqui
            if(strlen($request->prestamo_paquetes) == 3){
                $cosasPrestadas = $cosasPrestadas . $request->prestamo_paquetes . " Cantidad= 1" . "==>";
                //aqui agregamos el prestamo del osciloscopio y buscamos en la base de datos el osciloscopio y le restamos 1 a la cantidad que tiene disponible
                if(Instrumento::where('nombre','=','OSCILOSCOPIO')->get() != null){
                    //$prestamoNuevo = new Prestamo();
                    $instrumentos = Instrumento::where('nombre','=','OSCILOSCOPIO')->get();
                    if(sizeof($instrumentos) !=0){
                        $contador=0;
                        foreach ($instrumentos as $instrumento) {
                            if($contador < 2){
                                $resta = $instrumento->cantidad - 1;
                                $instrumento->cantidad = $resta;
                                /*
                                $prestamoNuevo->user_id=$request->usuario_id;
                                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                $prestamoNuevo->equipo_id=$instrumento->id;
                                $prestamoNuevo->componente_id=null;
                                $prestamoNuevo->cantidad_equipo=1;
                                $prestamoNuevo->cantidad_componente=0;
                                $prestamoNuevo->estado="ACTIVO";
                                $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                                */
                                $contador = $contador + 1;
                                $instrumento->save();
                            }
                        }
                       // $prestamoNuevo->save();
                    }
                }
                //comparamos si en la base de datos hay generadores
                if(Instrumento::where('nombre','=','GENERADOR')->get() != null){
                    //$prestamoNuevo = new Prestamo();
                    //buscamos los generadores disponibles en la base de datos
                    $instrumentos = Instrumento::where('nombre','=','GENERADOR')->get();
                    //verificamos que si se hallan encontrado generadores
                    if(sizeof($instrumentos) !=0){
                        $contador=0;
                        //metodo para recorrer todos los generadores encontrados
                        foreach ($instrumentos as $instrumento) {
                            //le restamos 1 a la cantidad disponible del generador
                            if($contador < 2){
                                $resta = $instrumento->cantidad - 1;
                                $instrumento->cantidad = $resta;
                                /*
                                $prestamoNuevo->user_id=$request->usuario_id;
                                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                $prestamoNuevo->equipo_id=$instrumento->id;
                                $prestamoNuevo->componente_id=null;
                                $prestamoNuevo->cantidad_equipo=1;
                                $prestamoNuevo->cantidad_componente=0;
                                $prestamoNuevo->estado="ACTIVO";
                                $prestamoNuevo->observaciones=strtoupper($request->observaciones);
                                */
                                $contador = $contador + 1;
                                $instrumento->save();
                            }   
                        }

                        //$prestamoNuevo->save();
                    }
                }
                //buscamos si hay fuentes en las bases de datos
                if(Instrumento::where('nombre','=','FUENTE')->get() != null){
                    //$prestamoNuevo = new Prestamo();
                    $instrumentos = Instrumento::where('nombre','=','FUENTE')->get();
                    //comparamos que se hayan encontrado fuentes o que no la variable $instrumentos no sea cero
                    if(sizeof($instrumentos) !=0){
                        $contador=0;
                        foreach ($instrumentos as $instrumento) {
                            if($contador < 2){
                                $resta = $instrumento->cantidad - 1;
                                $instrumento->cantidad = $resta;
                                /*
                                $prestamoNuevo->user_id=$request->usuario_id;
                                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                $prestamoNuevo->equipo_id=$instrumento->id;
                                $prestamoNuevo->componente_id=null;
                                $prestamoNuevo->cantidad_equipo=1;
                                $prestamoNuevo->cantidad_componente=0;
                                $prestamoNuevo->estado="ACTIVO";
                                $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                                */
                                $contador = $contador + 1;
                                $instrumento->save();
                            }
                        }

                        //$prestamoNuevo->save();
                    }
                }
            }
            //Comparamos si se eligieron paquetes solo con 2
            if(strlen($request->prestamo_paquetes) == 2){
                $cosasPrestadas = $cosasPrestadas . $request->prestamo_paquetes . " Cantidad= 1" . "==>";

                if($request->prestamo_paquetes == 'FO'){
                    if(Instrumento::where('nombre','=','OSCILOSCOPIO')->get() != null){
                        //$prestamoNuevo = new Prestamo();
                        $instrumentos = Instrumento::where('nombre','=','OSCILOSCOPIO')->get();
                        if(sizeof($instrumentos) !=0){
                            $contador=0;
                            foreach ($instrumentos as $instrumento) {
                                if($contador < 2){
                                    $resta = $instrumento->cantidad - 1;
                                    $instrumento->cantidad = $resta;
                                    /*
                                    $prestamoNuevo->user_id=$request->usuario_id;
                                    $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                    $prestamoNuevo->equipo_id=$instrumento->id;
                                    $prestamoNuevo->componente_id=null;
                                    $prestamoNuevo->cantidad_equipo=1;
                                    $prestamoNuevo->cantidad_componente=0;
                                    $prestamoNuevo->estado="ACTIVO";
                                    $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                                    */
                                    $contador = $contador + 1;
                                    $instrumento->save();
                                }
                            }
                            //$prestamoNuevo->save();
                        }
                    }

                    if(Instrumento::where('nombre','=','FUENTE')->get() != null){
                        //$prestamoNuevo = new Prestamo();
                        $instrumentos = Instrumento::where('nombre','=','FUENTE')->get();
                        //comparamos que se hayan encontrado fuentes o que no la variable $instrumentos no sea cero
                        if(sizeof($instrumentos) !=0){
                            $contador=0;
                            foreach ($instrumentos as $instrumento) {
                                if($contador < 2){
                                    $resta = $instrumento->cantidad - 1;
                                    $instrumento->cantidad = $resta;
                                    /*
                                    $prestamoNuevo->user_id=$request->usuario_id;
                                    $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                    $prestamoNuevo->equipo_id=$instrumento->id;
                                    $prestamoNuevo->componente_id=null;
                                    $prestamoNuevo->cantidad_equipo=1;
                                    $prestamoNuevo->cantidad_componente=0;
                                    $prestamoNuevo->estado="ACTIVO";
                                    $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                                    */
                                    $contador = $contador + 1;
                                    $instrumento->save();
                                }
                            }

                            //$prestamoNuevo->save();
                        }
                    }

                }
                elseif($request->prestamo_paquetes == 'FG'){
                    //comparamos si en la base de datos hay generadores
                    if(Instrumento::where('nombre','=','GENERADOR')->get() != null){
                        //$prestamoNuevo = new Prestamo();
                        //buscamos los generadores disponibles en la base de datos
                        $instrumentos = Instrumento::where('nombre','=','GENERADOR')->get();
                        //verificamos que si se hallan encontrado generadores
                        if(sizeof($instrumentos) !=0){
                            $contador=0;
                            //metodo para recorrer todos los generadores encontrados
                            foreach ($instrumentos as $instrumento) {
                                //le restamos 1 a la cantidad disponible del generador
                                if($contador < 2){
                                    $resta = $instrumento->cantidad - 1;
                                    $instrumento->cantidad = $resta;
                                    /*
                                    $prestamoNuevo->user_id=$request->usuario_id;
                                    $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                    $prestamoNuevo->equipo_id=$instrumento->id;
                                    $prestamoNuevo->componente_id=null;
                                    $prestamoNuevo->cantidad_equipo=1;
                                    $prestamoNuevo->cantidad_componente=0;
                                    $prestamoNuevo->estado="ACTIVO";
                                    $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                                    */
                                    $contador = $contador + 1;
                                    $instrumento->save();
                                }   
                            }

                            //$prestamoNuevo->save();
                        }
                    }
                    //buscamos si hay fuentes en las bases de datos
                    if(Instrumento::where('nombre','=','FUENTE')->get() != null){
                        //$prestamoNuevo = new Prestamo();
                        $instrumentos = Instrumento::where('nombre','=','FUENTE')->get();
                        //comparamos que se hayan encontrado fuentes o que no la variable $instrumentos no sea cero
                        if(sizeof($instrumentos) !=0){
                            $contador=0;
                            foreach ($instrumentos as $instrumento) {
                                if($contador < 2){
                                    $resta = $instrumento->cantidad - 1;
                                    $instrumento->cantidad = $resta;
                                    /*
                                    $prestamoNuevo->user_id=$request->usuario_id;
                                    $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                    $prestamoNuevo->equipo_id=$instrumento->id;
                                    $prestamoNuevo->componente_id=null;
                                    $prestamoNuevo->cantidad_equipo=1;
                                    $prestamoNuevo->cantidad_componente=0;
                                    $prestamoNuevo->estado="ACTIVO";
                                    $prestamoNuevo->observaciones=strtoupper($request->observaciones);
                                    */
                                    $contador = $contador + 1;
                                    $instrumento->save();
                                }
                            }

                            //$prestamoNuevo->save();
                        }
                    }
                }
                elseif($request->prestamo_paquetes == 'OG'){
                    //aqui agregamos el prestamo del osciloscopio y buscamos en la base de datos el osciloscopio y le restamos 1 a la cantidad que tiene disponible
                    if(Instrumento::where('nombre','=','OSCILOSCOPIO')->get() != null){
                        //$prestamoNuevo = new Prestamo();
                        $instrumentos = Instrumento::where('nombre','=','OSCILOSCOPIO')->get();
                        if(sizeof($instrumentos) !=0){
                            $contador=0;
                            foreach ($instrumentos as $instrumento) {
                                if($contador < 2){
                                    $resta = $instrumento->cantidad - 1;
                                    $instrumento->cantidad = $resta;
                                    /*
                                    $prestamoNuevo->user_id=$request->usuario_id;
                                    $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                    $prestamoNuevo->equipo_id=$instrumento->id;
                                    $prestamoNuevo->componente_id=null;
                                    $prestamoNuevo->cantidad_equipo=1;
                                    $prestamoNuevo->cantidad_componente=0;
                                    $prestamoNuevo->estado="ACTIVO";
                                    $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                                    */
                                    $contador = $contador + 1;
                                    $instrumento->save();
                                }
                            }
                            //$prestamoNuevo->save();
                        }
                    }
                    //comparamos si en la base de datos hay generadores
                    if(Instrumento::where('nombre','=','GENERADOR')->get() != null){
                        //$prestamoNuevo = new Prestamo();
                        //buscamos los generadores disponibles en la base de datos
                        $instrumentos = Instrumento::where('nombre','=','GENERADOR')->get();
                        //verificamos que si se hallan encontrado generadores
                        if(sizeof($instrumentos) !=0){
                            $contador=0;
                            //metodo para recorrer todos los generadores encontrados
                            foreach ($instrumentos as $instrumento) {
                                //le restamos 1 a la cantidad disponible del generador
                                if($contador < 2){
                                    $resta = $instrumento->cantidad - 1;
                                    $instrumento->cantidad = $resta;
                                    /*
                                    $prestamoNuevo->user_id=$request->usuario_id;
                                    $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                                    $prestamoNuevo->equipo_id=$instrumento->id;
                                    $prestamoNuevo->componente_id=null;
                                    $prestamoNuevo->cantidad_equipo=1;
                                    $prestamoNuevo->cantidad_componente=0;
                                    $prestamoNuevo->estado="ACTIVO";
                                    $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                                    */
                                    $contador = $contador + 1;
                                    $instrumento->save();
                                }   
                            }

                           // $prestamoNuevo->save();
                        }
                    }
                }
            }
        }
/*
* El siguiente metodo es para agregar solo los equipos como un prestamo individual como un prestamo individual
*/
        for ($i=0; $i < sizeof($request->prestamo_equipos); $i++){

            if ($request->cantidad_del_equipo[$i]!=0){
                //$prestamoNuevo = new Prestamo();
                $instrumentos = Instrumento::where('id','=',$request->prestamo_equipos[$i])->get();

                foreach ($instrumentos as $instrumento) {

                        $resta = $instrumento->cantidad - $request->cantidad_del_equipo[$i];
                        $instrumento->cantidad = $resta;

                        $cosasPrestadas = $cosasPrestadas . $instrumento->nombre . ' ' . $instrumento->tipo . " Cantidad= " . $request->cantidad_del_equipo[$i] . "==>";

                        /*
                        $prestamoNuevo->user_id=$request->usuario_id;
                        $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                        $prestamoNuevo->equipo_id=$instrumento->id;
                        $prestamoNuevo->componente_id=null;
                        $prestamoNuevo->cantidad_equipo=$request->cantidad_del_equipo[$i];
                        $prestamoNuevo->cantidad_componente=0;
                        $prestamoNuevo->estado="ACTIVO";
                        $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                        */

                    $instrumento->save();
                }
                //$prestamoNuevo->save();
            }
        }
/*
* El siguiente metodo es para agregar solo los componentes como un prestamos individuales
*/
        for ($i=0; $i < sizeof($request->prestamo_componentes); $i++){

            if ($request->cantidad_del_componente[$i]!=0){
                //$prestamoNuevo = new Prestamo();

                $componentes = Componente::where('id','=',$request->prestamo_componentes[$i])->get();

                foreach ($componentes as $componente) {
                    $resta = $componente->cantidad - $request->cantidad_del_componente[$i];
                    $componente->cantidad= $resta;

                    $cosasPrestadas = $cosasPrestadas . $componente->nombre . ' ' . $componente->referencia . " Cantidad= " . $request->cantidad_del_componente[$i] . "==>";
                    /*
                    $prestamoNuevo->user_id=$request->usuario_id;
                    $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                    $prestamoNuevo->equipo_id=null;
                    $prestamoNuevo->componente_id=$componente->id;
                    $prestamoNuevo->cantidad_equipo=0;
                    $prestamoNuevo->cantidad_componente=$request->cantidad_del_componente[$i];
                    $prestamoNuevo->estado="ACTIVO";
                    $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                    */                    
                    $componente->save();
                }
            //$prestamoNuevo->save();
            }
        }

        if (empty($request->cantidad_ohmios)) {
            
        }else{
            $cosasPrestadas = $cosasPrestadas . " " . "Resistencias de Ω = " . $request->cantidad_ohmios . "==>";
        }

        if (empty($request->cantidad_kiloohmios)) {
            
        }else{
            $cosasPrestadas = $cosasPrestadas . " " . "Resistencias de kΩ = " . $request->cantidad_kiloohmios . "==>";
        }

        if (empty($request->cantidad_miliohmios)) {
            
        }else{
            $cosasPrestadas = $cosasPrestadas . " " . "Resistencias de MΩ = " . $request->cantidad_miliohmios . "==>";
        }

        if (empty($request->cantidad_nanofaradios)) {
            
        }else{
            $cosasPrestadas = $cosasPrestadas . " " . "Condensadores de nF = " . $request->cantidad_nanofaradios . "==>";
        }

        if (empty($request->cantidad_picofaradios)) {
            
        }else{
            $cosasPrestadas = $cosasPrestadas . " " . "Condensadores de pF = " . $request->cantidad_picofaradios . "==>";
        }

        if (empty($request->cantidad_microfaradios)) {
            
        }else{
            $cosasPrestadas = $cosasPrestadas . " " . "Condensadores de uF = " . $request->cantidad_microfaradios . "==>";
        }

        if (empty($request->cantidad_inductor)) {
            
        }else{
            $cosasPrestadas = $cosasPrestadas . " " . "Inductores de uH = " . $request->cantidad_inductor . "==>";
        }

        if (empty($request->cantidad_potenciometro)) {
            
        }else{
            $cosasPrestadas = $cosasPrestadas . " " . "Potenciometros de kΩ = " . $request->cantidad_potenciometro . "==>";
        }

        
/*
* El siguiente metodo es para agregar las resistencias en OHMIOS como un prestamo individual
*/
/*
        if ($request->cantidad_de_la_resistencia_ohmios!=0){
            //$prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_ohmios . ' ' . 'Ω')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_de_la_resistencia_ohmios;
                $componente->cantidad= $resta;

                $cosasPrestadas = $cosasPrestadas . $componente->nombre . ' ' . $componente->referencia . ' Cantidad= ' . $request->cantidad_de_la_resistencia_ohmios . "==>";
                /*
                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_de_la_resistencia_ohmios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                */
                //$componente->save();
            //}
        //$prestamoNuevo->save();
        //}


/*
* El siguiente metodo es para agregar las resistencias en KILO_OHMIOS como un prestamo individual
*/
/*
        if ($request->cantidad_de_la_resistencia_kiloohmios!=0){
            //$prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_kiloohmios . ' ' . 'KΩ')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_de_la_resistencia_kiloohmios;
                $componente->cantidad= $resta;

                $cosasPrestadas = $cosasPrestadas . $componente->nombre . ' ' . $componente->referencia . ' Cantidad= ' . $request->cantidad_de_la_resistencia_kiloohmios . "==>";
                /*
                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_de_la_resistencia_kiloohmios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                */
                //$componente->save();
            //}
        //$prestamoNuevo->save();
       // }
/*
* El siguiente metodo es para agregar las resistencias en MEGA_OHMIOS como un prestamo individual
*/
/*
        if ($request->cantidad_de_la_resistencia_megaohmios!=0){
            //$prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_megaohmios . ' ' . 'MΩ')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_de_la_resistencia_megaohmios;
                $componente->cantidad= $resta;

                $cosasPrestadas = $cosasPrestadas . $componente->nombre . ' ' . $componente->referencia . ' Cantidad= ' . $request->cantidad_de_la_resistencia_megaohmios . "==>";

                /*
                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_de_la_resistencia_megaohmios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                */                
               // $componente->save();
            //}
        //$prestamoNuevo->save();
        //}
/*
* El siguiente metodo es para agregar los CONDENSADORES en NANO_FARADIOS como un prestamo individual
*/
/*
        if ($request->cantidad_de_la_condensadores_nanofaradios!=0){
            //$prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_nanofaradios . ' ' . 'nF')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_de_la_condensadores_nanofaradios;
                $componente->cantidad= $resta;

                $cosasPrestadas = $cosasPrestadas . $componente->nombre . ' ' . $componente->referencia . ' Cantidad= ' . $request->cantidad_de_la_condensadores_nanofaradios . "==>";
                /*
                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_de_la_condensadores_nanofaradios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                */
                //$componente->save();
            //}
        //$prestamoNuevo->save();
        //}
/*
* El siguiente metodo es para agregar los CONDENSADORES en PICO_FARADIOS como un prestamo individual
*/
/*
        if ($request->cantidad_del_condensador_picofaradios!=0){
            //$prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_picofaradios . ' ' . 'pF')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_del_condensador_picofaradios;
                $componente->cantidad= $resta;

                $cosasPrestadas = $cosasPrestadas . $componente->nombre . ' ' . $componente->referencia . ' Cantidad= ' . $request->cantidad_del_condensador_picofaradios . "==>";
                /*
                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_del_condensador_picofaradios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones= strtoupper($request->observaciones);
                */
                //$componente->save();
            //}
        //$prestamoNuevo->save();
        //}

/*
* El siguiente metodo es para agregar los CONDENSADORES en PICO_FARADIOS como un prestamo individual
*/
/*
        if ($request->cantidad_del_condensador_microfaradios!=0){
            //$prestamoNuevo = new Prestamo();
            
            $componentes = Componente::where('referencia','=',$request->capacidad_microfaradios . ' ' . 'uF')->get();

            foreach ($componentes as $componente) {
                $resta = $componente->cantidad - $request->cantidad_del_condensador_microfaradios;
                $componente->cantidad= $resta;

                $cosasPrestadas = $cosasPrestadas . $componente->nombre . ' ' . $componente->referencia . ' Cantidad= ' . $request->cantidad_del_condensador_microfaradios . "==>";
                /*
                $prestamoNuevo->user_id=$request->usuario_id;
                $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
                $prestamoNuevo->equipo_id=null;
                $prestamoNuevo->componente_id=$componente->id;
                $prestamoNuevo->cantidad_equipo=0;
                $prestamoNuevo->cantidad_componente=$request->cantidad_del_condensador_microfaradios;
                $prestamoNuevo->estado="ACTIVO";
                $prestamoNuevo->observaciones = strtoupper($request->observaciones);
                */
                //$componente->save();
            //}
        //$prestamoNuevo->save();
        //}

        $prestamoNuevo->user_id=$request->usuario_id;
        $prestamoNuevo->estudiante_id = $request->estudiante_actual_id;
        $prestamoNuevo->equipo_id=null;
        $prestamoNuevo->componente_id=null;
        $prestamoNuevo->cantidad_equipo=0;
        $prestamoNuevo->cantidad_componente=0;
        $prestamoNuevo->estado="ACTIVO";
        $prestamoNuevo->elementos= $cosasPrestadas;
        $prestamoNuevo->observaciones = strtoupper($request->observaciones);
        $prestamoNuevo->save();

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
        $prestamo->observaciones= strtoupper($request->observaciones);

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
       $prestamo=Prestamo::find($id);
       $instrumentos= DB::table('instrumentos')->get();
       $componentes= DB::table('componentes')->get();

        if($prestamo->elementos != null){

            foreach ($instrumentos as $instrumentoDeAyuda) {

                $instrumento=Instrumento::find($instrumentoDeAyuda->id);
                $pos = strpos($prestamo->elementos, $instrumento->nombre . ' ' . $instrumento->tipo . ' Cantidad= ');

                if ($pos !== false) {
                    $cantidadLetras = strlen($instrumento->nombre . ' ' . $instrumento->tipo . ' Cantidad= ');
                    $posicionDondeIniciaLaCantidad = $pos + $cantidadLetras - 1;

                    $cantidad = substr($prestamo->elementos, $posicionDondeIniciaLaCantidad + 1, 2);
                    
                    if(is_numeric($cantidad)) {
                        $suma0 = $cantidad +  $instrumento->cantidad;
                        $instrumento->cantidad=$suma0;
                        $instrumento->save(); 
                        $prestamo->estado="INACTIVO";
                        $prestamo->save();

                    }else{
                        
                        $cantidad1 = substr($prestamo->elementos, $posicionDondeIniciaLaCantidad + 1, 1);
                        $suma1 = $cantidad1 +  $instrumento->cantidad;
                        $instrumento->cantidad=$suma1;
                        $instrumento->save(); 
                        $prestamo->estado="INACTIVO";
                        $prestamo->save();
                    }
                }
            }

            foreach ($componentes as $componente) {
                $pos2 = strpos($prestamo->elementos, $componente->nombre . ' ' . $componente->referencia . ' Cantidad= ');
                if ($pos2 !== false) {
                    $cantidadLetras2 = strlen($componente->nombre . ' ' . $componente->referencia . ' Cantidad= ');
                    $posicionDondeIniciaLaCantidad2 = $pos2 + $cantidadLetras2 - 1;

                    $cantidad2 = substr($prestamo->elementos, $posicionDondeIniciaLaCantidad2, $posicionDondeIniciaLaCantidad2 + 1);
                    if(is_numeric($cantidad2)) {
                        $suma2 = $cantidad2 +  $componente->cantidad;
                        $componente->cantidad=$suma2;
                        $componente->save(); 
                        $prestamo->estado="INACTIVO";
                        $prestamo->save();

                    }else{
                        $cantidad2 = substr($prestamo->elementos, $posicionDondeIniciaLaCantidad2 + 1, 1);
                        $suma2 = $cantidad2 +  $componente->cantidad;
                        $componente->cantidad=$suma2;
                        $componente->save(); 
                        $prestamo->estado="INACTIVO";
                        $prestamo->save();
                    }
                }
            }

            $posicionPaqueteFOG = strpos($prestamo->elementos, 'FOG');
            $posicionPaqueteFO = strpos($prestamo->elementos, 'FO');
            $posicionPaqueteFG = strpos($prestamo->elementos, 'FG');
            $posicionPaqueteOG = strpos($prestamo->elementos, 'OG');

            if($posicionPaqueteFOG !== false){
                $instrumentoEncontrado1 = Instrumento::where('nombre', '=', 'FUENTE')->get();
                foreach ($instrumentoEncontrado1 as $instrumento1) {
                    $instrumento1->cantidad=$instrumento1->cantidad + 1;
                    $instrumento1->save();
                }

                $instrumentoEncontrado2 = Instrumento::where('nombre', '=', 'OSCILOSCOPIO')->get();
                foreach ($instrumentoEncontrado2 as $instrumento2) {
                    $instrumento2->cantidad=$instrumento2->cantidad + 1;
                    $instrumento2->save();
                }

                $instrumentoEncontrado3 = Instrumento::where('nombre', '=', 'GENERADOR')->get();
                foreach ($instrumentoEncontrado3 as $instrumento3) {
                    $instrumento3->cantidad=$instrumento3->cantidad + 1;
                    $instrumento3->save();
                }

                $prestamo->estado="INACTIVO";
                $prestamo->save();
            }

            if($posicionPaqueteFO !== false){
                $instrumentoEncontrado4 = Instrumento::where('nombre', '=', 'FUENTE')->get();
                foreach ($instrumentoEncontrado4 as $instrumento4) {
                    $instrumento4->cantidad=$instrumento4->cantidad + 1;
                    $instrumento4->save();
                }

                $instrumentoEncontrado5 = Instrumento::where('nombre', '=', 'OSCILOSCOPIO')->get();
                foreach ($instrumentoEncontrado5 as $instrumento5) {
                    $instrumento5->cantidad=$instrumento5->cantidad + 1;
                    $instrumento5->save();
                }

                $prestamo->estado="INACTIVO";
                $prestamo->save();
            }

            if($posicionPaqueteFG !== false){
                $instrumentoEncontrado6 = Instrumento::where('nombre', '=', 'FUENTE')->get();
                foreach ($instrumentoEncontrado6 as $instrumento6) {
                    $instrumento6->cantidad=$instrumento6->cantidad + 1;
                    $instrumento6->save();
                }

                $instrumentoEmcontrado7 = Instrumento::where('nombre', '=', 'GENERADOR')->get();
                foreach ($instrumentoEncontrado7 as $instrumento7) {
                    $instrumento7->cantidad=$instrumento7->cantidad + 1;
                    $instrumento7->save();
                }
                
                $prestamo->estado="INACTIVO";
                $prestamo->save();

            }

            if($posicionPaqueteOG !== false){
                $instrumentoEncontrado8 = Instrumento::where('nombre', '=', 'OSCILOSCOPIO')->get();
                foreach ($instrumentoEncontrado8 as $instrumento8) {
                    $instrumento8->cantidad=$instrumento8->cantidad + 1;
                    $instrumento8->save();
                }
                
                $instrumentoEncontrado9 = Instrumento::where('nombre', '=', 'GENERADOR')->get();
                foreach ($instrumentoEncontrado9 as $instrumento9) {
                    $instrumento9->cantidad=$instrumento9->cantidad + 1;
                    $instrumento9->save();
                }
                
                $prestamo->estado="INACTIVO";
                $prestamo->save();
            }           
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
