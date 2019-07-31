<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\atencion;
use App\descAtencion;
use App\clientes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AtenPendienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atenPendiente=atencion::join('desc_atencions as da','da.cod_aten','=','atencions.id')->get();
        return view('ViewsAtencion.pendientes');
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function storePendientes()
    {
        return atencion::join('clientes as cl', 'cl.id','=','atencions.cod_clie')
            ->where('atencions.aten_estadoPago',0)
            ->select('cl.vent_clienteApellido','cl.vent_clienteApellido2','cl.vent_clienteNit','cl.vent_clienteNombre','atencions.*')
            ->get();
    }
    public function show($id)
    {
        return atencion::join('desc_atencions as da', 'da.cod_aten','=','atencions.id')->where('atencions.id',$id)->first();
    }
    public function edit($id)
    {
        //
    }
    public function update($id,Request $request)
    {
        $CodIdDescAten=descAtencion::where('cod_aten',$id)->value('id');
//        return  $CodIdDescAten;


        $dato=$request->input("aten_fecha2");
        $dato = Carbon::createFromFormat('d/m/Y H:i',$dato)->format('Y-m-d H:i');
        $aten=  atencion::find($id);
        $aten->cod_usu=Auth::user()->usu_ci;
        $aten->cod_clie=$request->input('cod_clie');
        $aten->aten_precio=$request->input('aten_precio');
        $aten->aten_aCuenta=$request->input('aten_aCuenta');
        $aten->aten_Saldo=$request->input('aten_Saldo');
        $aten->aten_estadoPago=0;
        $aten->aten_fecha1=Carbon::now();
        $aten->aten_fecha2=$dato;
        $rev = $aten->save();
        if ($rev){
            $DeAt= descAtencion::find($CodIdDescAten);
//            $DeAt->cod_aten= $aten->id;
//----------------------------------SECTOR A
            $DeAt->da_cristales= $request->input("da_cristales");
            $DeAt->da_armazon= $request->input("da_armazon");
            $DeAt->da_organicos= $request->input("da_organicos");
            $DeAt->da_tinte= $request->input("da_tinte");
            $DeAt->da_uv= $request->input("da_uv");
            $DeAt->da_pcr= $request->input("da_pcr");

//----------------------------------SECTOR B-1
            $DeAt->da_lejosODest= $request->input("da_lejosODest");
            $DeAt->da_lejosODCil= $request->input("da_lejosODCil");
            $DeAt->da_lejosODEje= $request->input("da_lejosODEje");
            $DeAt->da_lejosODDip= $request->input("da_lejosODDip");

            $DeAt->da_lejosOLest= $request->input("da_lejosOLest");
            $DeAt->da_lejosOLCil= $request->input("da_lejosOLCil");
            $DeAt->da_lejosOLEje= $request->input("da_lejosOLEje");
            $DeAt->da_lejosOLDip= $request->input("da_lejosOLDip");

//-----------------------------------SECTOR B-2
            $DeAt->da_cercaODest= $request->input("da_cercaODest");
            $DeAt->da_cercaODCil= $request->input("da_cercaODCil");
            $DeAt->da_cercaODEje= $request->input("da_cercaODEje");
            $DeAt->da_cercaODDip= $request->input("da_cercaODDip");

            $DeAt->da_cercaOLest= $request->input("da_cercaOLest");
            $DeAt->da_cercaOLCil= $request->input("da_cercaOLCil");
            $DeAt->da_cercaOLEje= $request->input("da_cercaOLEje");
            $DeAt->da_cercaOLDip= $request->input("da_cercaOLDip");

            //---------------------------SECTOR C
            $DeAt->da_focales= $request->input("da_focales");
            $DeAt->da_otros= $request->input("da_otros");
            $DeAt->da_alt= $request->input("da_alt");
            $DeAt->da_ad= $request->input("da_ad");
            $DeAt->da_doctor= $request->input("da_doctor");
            $DeAt->da_estuche= $request->input("da_estuche");
            $DeAt->da_observaciones= $request->input("da_observaciones");
            $r=$DeAt->save();
        }
        if ($r){
            return"success";
        }else{
            return"fail";
        }
    }
    public function destroy($id)
    {
        $cont1=0;
        $cont2=0;
        do {
            $cont1+=10;
            if ($cont1==2){break;}
            $ver = atencion::where('id', $id)->delete();
        } while ($ver==0);
        if ($ver){
            do{
                $cont2+=100;
                $veri = descAtencion::where('cod_aten', $id)->delete();
            }while($veri==0);
        }
        if ($ver&&$veri){
            return "success";
        }else if($veri){
            return"success1";
        }else{
            return"fail";
        }

    }
    public function atenPagada($id){
        $dat=atencion::find($id);
        $dat->aten_estadoPago=1;
        $rev=$dat->save();
        if ($rev){return"success";}else{return"fail";}
    }
}
