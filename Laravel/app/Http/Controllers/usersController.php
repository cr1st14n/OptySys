<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Users;
use Illuminate\Support\Facades\Auth;
//use Carbon\Carbon;

class usersController extends Controller
{
    public function index()
    {
        $user= User::orderBy('id','desc')->get();
        return view('ViewUsers.homeUsers')->with("listUsers",$user);
    }
    public function create(Request $request)
    {
        $ver = Users::where('usu_ci',($request->input("ci")))->first();
        if ($ver == null){
            $user = new Users();
            $user->usu_ci=$request->input("ci");
            $user->usu_nombre=$request->input("nombre");
            $user->usu_appaterno=$request->input("appaterno");
            $user->usu_apmaterno=$request->input("apmaterno");
            $user->usu_cargo=$request->input("cargo");
            $user->usu_acceso=$request->input("acceso");

            $user->password=bcrypt("12345");
            $user->usu_modulo="Ventas";

            $user->ca_usu_cod=Auth::user()->usu_ci;
            $user->ca_tipo="create";
            $user->ca_fecha=Carbon::now();
            $user->ca_estado=1;
            $rev = $user->save();
            if ($rev){
                return "creado";
            }else{
                return "creadoError";
            }

//            return "create usuario";
        }else{
            return "duplicado";
        }


        return $request;
    }
    public function store(Request $request)
    {
        return Users::select('id','usu_ci','usu_nombre','usu_appaterno','usu_apmaterno','usu_cargo','usu_acceso')->orderBy('id','asc')->get();
    }
    public function show($id)
    {
        return Users::select('id','usu_ci','usu_nombre','usu_appaterno','usu_apmaterno','usu_cargo','usu_acceso')->where('id',$id)->first();
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request)
    {
        $usu1 = $request->input("ci");
        $usu2 = Users::where('id',($request->input("id")))->value('usu_ci');
        $ver = Users::where('usu_ci',($request->input("ci")))->value('usu_ci');
        if ($ver == null || $usu1 == $usu2){
            $rev= Users::where('id',$request->input("id"))->update([
            'usu_ci'=>$request->input("ci"),
            'usu_nombre'=>$request->input("nombre"),
            'usu_appaterno'=>$request->input("appaterno"),
            'usu_apmaterno'=>$request->input("apmaterno"),
            'usu_cargo'=>$request->input("cargo"),
            'usu_modulo'=>$request->input("cargo"),
            'ca_usu_cod'=>Auth::user()->usu_ci,
            'ca_tipo'=>"update",
            'ca_fecha'=>Carbon::now(),
            'ca_estado'=>1]);
            if ($rev){
                return "creado";
            }else{
                return "creadoError";
            }
        }else{
            return "duplicado";
        }
        return $request;
    }
    public function destroy($id)
    {
        $ver = Users::where('id',$id)->delete();
        if ($ver){
            return 1;
        }else{
            return 0;
        }
    }
    public function gestAcceso($id)
    {
        $usu = User::where('id',$id)->value('usu_acceso');
        if ($usu ==1){
            $rev=User::where('id',$id)->update(['usu_acceso'=>0]);
        }else{
            $rev=User::where('id',$id)->update(['usu_acceso'=>1]);
        }
        if ($rev){
            return"correcto";
        }else{
            return"error";
        }
        return"errorControler";
    }
//    -----------------------------perfin de usuario
    public function perfilUser(){
        return view('ViewUsers.perfiluser');
    }
    public function updatePerfil(Request $request)
    {
        $usu1 = $request->input("ci");
        $usu2 = Users::where('id',($request->input("id")))->value('usu_ci');
        $ver = Users::where('usu_ci',($request->input("ci")))->value('usu_ci');
        if ($ver == null || $usu1 == $usu2){
            $rev= Users::where('id',$request->input("id"))->update([
                'usu_ci'=>$request->input("ci"),
                'usu_nombre'=>$request->input("nombre"),
                'usu_appaterno'=>$request->input("appaterno"),
                'usu_apmaterno'=>$request->input("apmaterno"),
                'ca_usu_cod'=>Auth::user()->usu_ci,
                'ca_tipo'=>"update",
                'ca_fecha'=>Carbon::now(),
                'ca_estado'=>1]);
            if ($rev){
                return "creado";
            }else{
                return "creadoError";
            }
        }else{
            return "duplicado";
        }
        return $request;
    }
    public function perfilUserRefresh()
    {
        return view('ViewUsers.perfiluserRefresh');
    }
}
