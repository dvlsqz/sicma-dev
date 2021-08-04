<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\DabFr, App\Http\Models\IncomeDetailDabFr,App\Http\Models\MaintenanceArea, App\Http\Models\Product, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth, Session, DB, Response; 

class DabFrController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){
        
        $dabs = DabFr::orderBy('id', 'Asc')->paginate(15);

        $data = [
            'dabs' => $dabs
        ];

    	return view('admin.dab_fr.home', $data);
    }

    public function getDabAdd(){
        $products = Product::get();
        if(Auth::user()->idmaintenancearea != 0 ):
            $maintenance_areas = MaintenanceArea::where('id', Auth::user()->idmaintenancearea)->get();
        else:
            $maintenance_areas = MaintenanceArea::get();
        endif;

        $data = [
            'products' => $products,
            'maintenance_areas' => $maintenance_areas
        ];

        return view('admin.dab_fr.add',$data);
    }

    public function postDabAdd(Request $request){
        $rules = [
            'no_doc' => 'required'
        ];

        $messages = [
            'no_doc.required' => 'Se requiere un numero para el documento de ingreso.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', '¡Se ha producido un error!.')
            ->withInput();
        else:

            DB::beginTransaction();

            $ingreso = new DabFr;
            $ingreso->id=$request->get('id');
            $ingreso->idmaintenancearea=$request->get('idsupplier');
            $ingreso->no_doc=$request->get('no_doc');
            $ingreso->accountable=$request->get('accountable');
            $ingreso->ibm_accountable=$request->get('ibm_accountable');
            $ingreso->save();

            $idarticulo=$request->get('idarticulo');
            $cantidad=$request->get('cantidad');

            $cont=0;

            while ($cont<count($idarticulo)) {
                $detalle=new IncomeDetailDabFr();
                $detalle->iddab=$ingreso->id;
                $detalle->idproduct=$idarticulo[$cont];
                $detalle->amount=$cantidad[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();

            if($ingreso->save()):
                $b = new Bitacora;
                $b->action = "Creaciòn de DAB-75 ".$ingreso->no_doc." para fondo rotativo.";
                $b->user_id = Auth::id();
                $b->save();
                Session::flash('success', '¡DAB-75 guardada con exito!.');
                return redirect('/admin/dab_75_fr');
            endif;
        endif;

    }

    public function getDabShow($id){
        $dabs = DabFr::findOrFail($id);
        $details = IncomeDetailDabFr::where('iddab', $id)->get();
        $iddab = $id;

        $data = [
            'dabs' => $dabs,
            'details' => $details,
            'iddab' => $iddab
        ];

        return view('admin.dab_fr.show',$data);
    }
}
