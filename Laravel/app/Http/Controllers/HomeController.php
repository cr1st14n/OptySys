<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\atencion;
use App\descAtencion;
use App\clientes;
use App\Users;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function indexSystema()
    {
        $usuarios=User::count();
        $clientes=clientes::count();
        $ventas=atencion::where('aten_estadoPago',1)->count();
        $pendientes=atencion::where('aten_estadoPago',0)->count();
        $dateMes=Carbon::now()->format('m');
        $dateDia=Carbon::now()->format('d');
        $clieDescuento=clientes::whereDay('usu_fechNac',$dateDia)
                                    ->whereMonth('usu_fechNac',$dateMes)->count();
        return view('homeSystema')
            ->with("user",$usuarios)
            ->with("userDescuento",$clieDescuento)
            ->with("clientes",$clientes)
            ->with("ventas",$ventas)
            ->with("pendientes",$pendientes);
    }
}
