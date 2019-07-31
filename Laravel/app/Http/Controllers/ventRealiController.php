<?php

namespace App\Http\Controllers;

use App\atencion;
use Illuminate\Http\Request;

class ventRealiController extends Controller
{
    public function index()
    {
        return view('ViewsAtencion.ventReali');
    }
    public function list1(Request $request)
    {
        return atencion::join('users as u','u.usu_ci','atencions.cod_usu')
            ->join('clientes as cl','cl.id','=','atencions.cod_clie')
            ->select('cl.vent_clienteNombre','cl.vent_clienteApellido','cl.vent_clienteApellido2','cl.vent_clienteNit',
                'u.usu_nombre','u.usu_ci','atencions.*')
            ->whereDate('aten_fecha2',$request->input('fecha1'))->get();
    }
    public function list2(Request $request)
    {
        return atencion::join('users as u','u.usu_ci','atencions.cod_usu')
            ->join('clientes as cl','cl.id','=','atencions.cod_clie')
            ->select('cl.vent_clienteNombre','cl.vent_clienteApellido','cl.vent_clienteApellido2','cl.vent_clienteNit',
                'u.usu_nombre','u.usu_ci','atencions.*')
            ->whereDate('aten_fecha2','>=',$request->input('fecha1'))->
            whereDate('aten_fecha2','<=',$request->input('fecha2'))
            ->get();
    }

}
