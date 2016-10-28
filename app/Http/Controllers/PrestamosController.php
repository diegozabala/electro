<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Profesor;
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
        $prestamos= DB::table('profesores')
            ->join('prestamos','profesores.id','=','prestamos.profesores_id')
            ->join('equipos','equipos.id','=','prestamos.equipos_id')
            ->join('users','users.id','=','prestamos.user_id')
            ->select('prestamos.*','profesores.nombre_profesor','profesores.apellido_profesor','profesores.cedula'
                ,'equipos.nombre','users.name','users.apellido')->get();
        
        //-------------equipos prestados-----------//
        $portatiles=DB::table('equipos')
            ->where('estado','ocupado')->where('nombre','LIKE','P%')->count();

        $vb=DB::table('equipos')
            ->where('estado','ocupado')->where('tipo','VB')->count();

        $apun=DB::table('equipos')
            ->where('estado','ocupado')->where('nombre','LIKE','A%')->count();


        return view('admin/prestamos/index')->with('prestamos',$prestamos)->with('portatiles',$portatiles)
            ->with('vb',$vb)->with('apun',$apun);

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

        $equipo = new Equipo();
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
        $equipo1= new Equipo();
        $user= User::where('nombre','=',$request->nombre);
        for ($i=0; $i < $tamaño; $i++){
            if ($tamaño==1){
                $prestamos = new Prestamo();
                $equipo = Equipo::where('nombre','=',$nombres[$i])->get();
                $equipo1= $equipo[0];
                if ($equipo1->tipo=="EX"){
                    $equipo1->estado="disponible";
                }
                else{
                    $equipo1 ->estado="ocupado";
                }


                $prestamos->adicion=$var;
                $prestamos->equipos_id=$equipo[0]["id"];
                $prestamos->observaciones=$request->observaciones;
                $prestamos->profesores_id=$request->codigo;
                $prestamos->user_id=$request->nombre;
                $equipo1->save();
                $prestamos->save();
                $prestamos=null;
                $equipo=null;
                $equipo1=null;
            }
            else{
                $prestamos = new Prestamo();
                $equipo = Equipo::where('nombre','=',$nombres[$i])->get();
                $equipo1= $equipo[0];
                if ($equipo->tipo=="EX"){
                    $equipo->estado="disponible";
                }
                else{
                    $equipo1->estado="ocupado";
                }
                $prestamos->adicion=$var;
                $prestamos->equipos_id=$equipo[0]["id"];
                $prestamos->observaciones=$request->observaciones;
                $prestamos->profesores_id=$request->codigo;
                $prestamos->user_id=$request->nombre;
                $equipo1->save();
                $prestamos->save();
                $prestamos=null;
                $equipo=null;
                $equipo1=null;
                $var="";
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
        $profe=Profesor::find($prestamo->profesores_id);
        return view('admin/prestamos/edit')->with('prestamo',$prestamo)->with('profesor',$profe);
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
       $equipo=Equipo::find($prestamos->equipos_id);
       $equipo->estado="disponible";
       $equipo->save();
       $prestamos->delete();
       return redirect()->route('admin.prestamos.index');

   }

    public function find(Request $request){
        $nombre=$request->codigo;

            $equipos = Equipo::where('estado', '=', 'disponible')->orderBy('nombre', 'asc')->get();
            $profesor = Profesor::where('cedula', '=', $nombre)->get();
        if (count($profesor)==0){
            return view('errors.503');
            }
        return view('admin/prestamos/find')->with('profesor',$profesor)->with('equipos',$equipos);


        

    }
    public function find1(Request $request){
        $nombre=$request->nombre;

        $equipos = Equipo::where('estado', '=', 'disponible')->orderBy('nombre', 'asc')->get();
        $profesor = Profesor::where('nombre_profesor', 'LIKE', '%'.$nombre.'%')->get();
        if (count($profesor)==0){
            return view('errors.503');
        }
        elseif (count($profesor)>1){
            
            
            return view('admin/prestamos/profes')->with('profesores',$profesor);
        }

        return view('admin/prestamos/find')->with('profesor',$profesor)->with('equipos',$equipos);




    }
    
}
