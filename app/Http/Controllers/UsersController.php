<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;


class UsersController extends Controller
{

    public function index(){
        $users= User::orderBy('name','asc')->paginate(10);
        return view('admin/users/index')->with('users',$users);
    }
    public function create(){
        return view('admin.users.create');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request){

        
        if ($file=$request->file('imagen')){
            $file=$request->file('imagen');
            $name= 'usuario_'.time(). ".".$file->getClientOriginalExtension();
            $path=public_path()."/images/users/";
            $file->move($path,$name);

            $usuario = new User($request->all());
            $usuario->rol=$request->rol;
            $usuario->imagen=$name;
            $usuario->name=$request->name;
            $usuario->apellido=$request->apellido;
            $usuario->cedula=$request->cedula;
            $usuario->password=bcrypt($request->password);
            $usuario->save();
        }
        return redirect()->route('admin.users.index');
        

    }
    public function destroy($id){
        $user=User::find($id);
        $user->delete();
        return redirect(route('admin.users.index'));
    }
    public function show($id){
        $users=User::find($id);
        return view('admin/users/show')->with('users',$users);
    }
    public function edit($id){
        $user=User::find($id);
        return view('admin/users/edit')->with('user',$user);
    }
    public function update(Request $request,$id){
        $user=User::find($id);

            $user->name=$request->name;
            $user->apellido=$request->apellido;
            $user->email=$request->email;
            $user->cedula=$request->cedula;

            $user->save();
            return redirect()->route('admin.users.index');

    }
    public function pass($id){
        $user=User::find($id);
        return view('admin.users.pass')->with('user',$user);
        
    }
    public function pass1(Request $request,$id){
        $user=User::find($id);
        $user->password=bcrypt($request->password);
        $user->save();
       return redirect('/logout');
    }
}
