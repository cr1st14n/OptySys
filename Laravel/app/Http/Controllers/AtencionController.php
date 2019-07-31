<?php

namespace App\Http\Controllers;

use App\atencion;
use App\descAtencion;
use App\clientes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtencionController extends Controller
{
    public function index()
    {
        return view('ViewsAtencion.homeAtencion');
    }
    public function create(Request $request)
    {
        $dato=$request->input("aten_fecha2");
        $dato = Carbon::createFromFormat('d/m/Y H:i',$dato)->format('Y-m-d H:i');
        $aten= new atencion();
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
            $DeAt=new descAtencion();
            $DeAt->cod_aten= $aten->id;
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
            if ($r){
                return "success";
            }else{
                $t=atencion::where('id',$aten->id)->delete();
                if ($t){$t=atencion::where('id',$aten->id)->delete(); return"error";}else{$t=atencion::where('id',$aten->id)->delete();return"error";}
            }
        }else{
            return "error";
        }
    }
    public function store(Request $request)
    {
        //
    }
    public function show(atencion $atencion)
    {
        //
    }
    public function edit(atencion $atencion)
    {
        //
    }
    public function update(Request $request, atencion $atencion)
    {
        //
    }
    public function destroy(atencion $atencion)
    {
        //
    }
    public function busc1($ci){
        return clientes::where('vent_clienteNit',$ci)->orderBy('vent_clienteNit','desc')->limit(50)->get();
    }
    public function busc2($texto)
    {
        #return $texto;
        $var_Busqueda='';
        $apep='';
        $apem='';
        $apem2='';
        $a = '';
        $b = '';
        $c = '';
        //fragmentar input por estacio
        $trozo = preg_split("/[-]+/", $texto);
        for ($i=0; $i < count($trozo); $i++) {
            switch ($i) {
                case '0':
                    $nom=$trozo[$i];
                    break;
                case '1':
                    $apep=$trozo[$i];
                    break;
                case '2':
                    $apem=$trozo[$i];
                    break;
                case '3':
                    $apem2=$trozo[$i];
                    break;
            }
        }

        if ($apem2 != '') {$apem="$apem $apem2";}
        //generar valores de verdad
        if ($nom == '0' || $nom == null) {$a='f';}else{$a='v';}
        if ($apep == '0' || $apep == null) {$b='f';}else{$b='v';}
        if ($apem == '0'|| $apem == null || $apem == ' ' ) {$c='f';}else{$c='v';}

        $var_Busqueda="$nom $apep $apem";
        $i="$a$b$c";
        switch ($i) {
            case 'vvv':
                # code...
                //echo "primera iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1'";
                //$pacientes = pacientes::where(('pa_nombre','Like',$nom.'%') && 'pa_appaterno','Like',$apep.'%' && 'pa_apmaterno','Like',$apem.'%')->get();

                return clientes::Where(function($q) use ($nom,$apep,$apem){
                    $q->where('vent_clienteNombre','like','%'.$nom.'%')
                        ->where('vent_clienteApellido','like',$apep.'%')
                        ->Where('vent_clienteApellido2','like',$apem.'%'); })->limit(50)->get();
                //$pacientes=pacientes::where([['pa_nombre','like','%'.$nom.'%'],['pa_appaterno','like',$apep.'%'],['pa_apmaterno','like',$apem.'%']])->get();
                break;
            case 'vvf':
                # code...
                //echo "segunda iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' " ;
                return clientes::Where(function($q) use ($nom,$apep,$apem){
                    $q->where('vent_clienteNombre','like','%'.$nom.'%')
                        ->where('vent_clienteApellido','like',$apep.'%'); })->limit(50)->get();
                break;
            case 'vfv':
                # code...
                //echo "tercera iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
                return clientes::Where(function($q) use ($nom,$apep,$apem){
                    $q->where('vent_clienteNombre','like','%'.$nom.'%')
                        ->Where('vent_clienteApellido2','like',$apem.'%'); })->limit(50)->get();
                break;
            case 'vff':
                # code...
                //echo "cuarta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
                return clientes::Where(function($q) use ($nom,$apep,$apem){
                    $q->where('vent_clienteNombre','like','%'.$nom.'%'); })->limit(50)->get();


                break;
            case 'fvv':
                # code...
                //echo "quinta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
                return clientes::Where(function($q) use ($nom,$apep,$apem){
                    $q->where('vent_clienteNombre','like',$apep.'%')
                        ->Where('vent_clienteApellido2','like',$apem.'%'); })->limit(50)->get();
                break;
            case 'fvf':
                # code...
                //echo "sexta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
                return clientes::Where(function($q) use ($nom,$apep,$apem){
                    $q->where('vent_clienteApellido','like',$apep.'%')
                    ; })->limit(50)->get();
                break;
            case 'ffv':
                # code...
                //echo "septima iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
                return clientes::Where(function($q) use ($nom,$apep,$apem){
                    $q->Where('vent_clienteApellido2','like',$apem.'%'); })->limit(50)->get();
                break;
            case 'fff':
                # code...
                //echo "octava iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
                $tabla='0';
//                return view('viewRecepcion.formBuscarPaciente')->with("tabla",$tabla)->with("num",$var_num)->with("Busqueda",$var_Busqueda);

                break;

            default:
                # code...
                break;
        }
        return "";
    }
}
