<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\atencion;
use App\descAtencion;
use App\clientes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class reporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ViewsReportes.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return atencion::select('created_at',\DB::raw('count(*) as total'))->groupBy('created_at')->get();
        $var= atencion::select(\DB::raw('month(atencions.created_at) as mess'),\DB::raw('count(*) as total'))
            ->groupBy('mess')
            ->orderBy('mess','asc')
            ->get();

        return $var;
        /*DB::table('pedidos')
            ->select(DB::raw('count(*) as total'), DB::raw('MONTH(pedidos.created_at) AS mes'))
            ->where('pedidos.estado_id', '=', '1')
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();*/

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
