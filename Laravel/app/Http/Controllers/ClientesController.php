<?php

namespace App\Http\Controllers;

use App\atencion;
use App\clientes;
use App\descAtencion;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ClientesController extends Controller
{
    public function index()
    {
        $clientes = clientes::orderBy('id','desc')->get();
        return view('ViewsClie.homeClientes')->with("clientes",$clientes);
    }
    public function create(Request $request)
    {
        $ver = clientes::where('vent_clienteNit',($request->input("ciNit")))->first();
        if ($ver == null){
            $client = new clientes();
            $client->vent_clienteNit=$request->input("ciNit");
            $client->vent_clienteNombre=$request->input("nombre");
            $client->vent_clienteApellido=$request->input("apellido");

            $rev = $client->save();
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
        return clientes::orderBy('id','desc')->get();

    }
    public function show(clientes $clientes)
    {
        //
    }
    public function edit($id)
    {
        return clientes::where('id',$id)->first();
    }
    public function update(Request $request)
    {
        $usu2 = $request->input("ci");
        $ver = clientes::where('vent_clienteNit',($request->input("ci")))->value('vent_clienteNit');
        $usu1 = clientes::where('id',($request->input("id")))->value('vent_clienteNit');
//        return "$usu $ver";
        if ($ver == null || $usu1 == $usu2){
            $rev= clientes::where('id',$request->input("id"))->update([
                'vent_clienteNit'=>$request->input("ci"),
                'vent_clienteNombre'=>$request->input("nombre"),
                'vent_clienteApellido'=>$request->input("apellido"),

                'ca_cod_usu'=>Auth::user()->usu_ci,
                'ca_tipo'=>"update",
                'ca_fecha'=>Carbon::now(),
                'ca_estado'=>1]);
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
    public function destroy($id)
    {
        $ver= clientes::where('id',$id)->delete();
        if ($ver){return"success";}else{return"error";}
    }
    public function historiClie($id)
    {
        $data= atencion::where('cod_clie',$id)->get();
        $count=0;
        foreach ($data as $var){
            $count+=1;
        }
        if($count==0){
            return "sinDatos";
        }else{
            return $data;
        }
    }
    public function historiClieDetalle($id)
    {
        return atencion::join('desc_atencions as da','da.cod_aten','=','atencions.id')->where('cod_aten',$id)->first();
//        return descAtencion::where('cod_aten',$id)->first();
    }
}
