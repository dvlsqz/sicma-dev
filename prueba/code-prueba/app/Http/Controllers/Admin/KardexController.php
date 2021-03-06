<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Kardex, App\Http\Models\Product, App\Http\Models\MaintenanceArea, App\Http\Models\Bitacora, App\Http\Models\IncomeKardex, App\Http\Models\IncomeDetailKardex, App\Http\Models\EgressKardex, App\Http\Models\EgressDetailKardex ;
use Validator, Str, Config, Auth, Session, DB, Response; 

class KardexController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getKardex($status){
        if(Auth::user()->role == "0"):
            switch ($status) {
                case '0':
                    $kardex = Kardex::where('type', '0')->orderBy('id', 'Asc')->paginate(25);
                break;
    
                case '1':
                    $kardex = Kardex::where('type', '1')->orderBy('id', 'Asc')->paginate(25);
                break;
    
                case '2':
                    $kardex = Kardex::where('type', '2')->orderBy('id', 'Asc')->paginate(25);
                break;
    
                case '3':
                    $kardex = Kardex::where('type', '3')->orderBy('id', 'Asc')->paginate(25);
                break;
    
                case 'all':
                    $kardex = Kardex::orderby('id','Asc')->paginate(30);
                break;
    
                case 'trash':
                    $kardex = Kardex::onlyTrashed()->orderBy('id', 'Asc')->paginate(25);
                break;
            }
        else:
            switch ($status) {
                case '0':
                    $kardex = Kardex::where('type', '0')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->paginate(25);
                break;
    
                case '1':
                    $kardex = Kardex::where('type', '1')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->paginate(25);
                break;
    
                case '2':
                    $kardex = Kardex::where('type', '2')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->paginate(25);
                break;
    
                case '3':
                    $kardex = Kardex::where('type', '3')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->paginate(25);
                break;
    
                case 'all':
                    $kardex = Kardex::where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderby('id','Asc')->paginate(30);
                break;
    
                case 'trash':
                    $kardex = Kardex::onlyTrashed()->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->paginate(25);
                break;
            }
        endif;

        $data = [
            'kardex'=>$kardex,
        ];

        return view('admin.kardex.home',$data);
    }

    public function getKardexAdd(){

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

        return view('admin.kardex.add', $data);
    }

    public function postKardexAdd(Request $request){

        $rules = [
            'idproduct' => 'required',
            'idmaintenancearea' => 'required'
        ];

        $messages = [
            'idproduct.required' => 'Se requiere que seleccione un insumo para registrar.',
            'idmaintenancearea.required' => 'Se require que seleccione un area.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '??Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $k = new Kardex;
            $k->idproduct =  $request->input('idproduct');
            $k->idmaintenancearea =  $request->input('idmaintenancearea');
            $k->code_mantto_int =  $request->input('code_mantto_int');
            $k->stock =  "0";
            $k->observations =  $request->input('observations');

            if($k->save()):
                $b = new Bitacora;
                $b->action = "Registro de insumo ".$k->code_mantto_int." a kardex de area ".$k->area->name;
                $b->user_id = Auth::id();
                $b->save();
                return redirect('/admin/kardex/all')->with('messages', '??Registro de Producto en Kardex Guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getKardexEdit($id){

        $kardex = Kardex::findOrFail($id);
        $incomes_details_kardex = IncomeDetailKardex::get();
        $egress_details_kardex = EgressDetailKardex::get();
        $idproduct = $id;

        $data = [
            'kardex' => $kardex,
            'incomes_details_kardex' => $incomes_details_kardex,
            'egress_details_kardex' => $egress_details_kardex,
            'idproduct' => $idproduct
        ];

        return view('admin.kardex.edit',$data);
    }

    public function postKardexEdit($id, Request $request){

        $rules = [
            'observations' => 'required'
        ];

        $messages = [
            'observations.required' => 'Se requiere que llene las observaciones.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', '??Se ha producido un error!.')
            ->withInput();
        else:

            $k = Kardex::findOrFail($id);
            $k->observations =  $request->input('observations');

            if($k->save()):
                $b = new Bitacora;
                $b->action = "Actualizacion de insumo ".$k->code_mantto_int." a kardex de area ".$k->area->name;
                $b->user_id = Auth::id();
                $b->save();
                Session::flash('success', '??Producto guardado con exito!.');
                return redirect('/admin/kardex/all');
            endif;
        
        endif;
    }

    public function getKardexIncome(){
        

        if(Auth::user()->idmaintenancearea != 0 ):
            $maintenance_areas = MaintenanceArea::where('id', Auth::user()->idmaintenancearea)->get();
            $kardex = Kardex::where('idmaintenancearea', Auth::user()->idmaintenancearea)->get();
        else:
            $maintenance_areas = MaintenanceArea::get();
            $kardex = Kardex::get();
        endif;

        $data = [
            'kardex' => $kardex,
            'maintenance_areas' => $maintenance_areas
        ];

        return view('admin.kardex.income',$data);
    }

    public function postKardexIncome(Request $request){
        $rules = [
            'no_doc' => 'required',
            'idsupplier' => 'required',
        ];

        $messages = [
            'no_doc.required' => 'Se requiere un numero para el documento de ingreso.',
            'idsupplier.required' => 'Se requiere que selecciones un area de mantenimiento para registrar el ingreso.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '??Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
          
            DB::beginTransaction();

            $ingreso = new IncomeKardex;
            $ingreso->id=$request->get('id');
            $ingreso->idmaintenancearea=$request->get('idsupplier');
            $ingreso->type_doc=$request->get('type_doc');
            $ingreso->no_doc=$request->get('no_doc');
            $ingreso->accountable=e($request->get('accountable'));
            $ingreso->ibm_accountable=e($request->get('ibm-accountable'));
            $ingreso->save();

            $idarticulo=$request->get('idarticulo');
            $cantidad=$request->get('cantidad');

            $cont=0;

            while ($cont<count($idarticulo)) {
                $detalle=new IncomeDetailKardex();
                $detalle->idincome=$ingreso->id;
                $detalle->idproduct=$idarticulo[$cont];
                $detalle->amount=$cantidad[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();
           

            if($ingreso->save()):
                $b = new Bitacora;
                $b->action = "Registro de ingreso a kardex, documento no. ".$ingreso->code_ppr;
                $b->user_id = Auth::id();
                $b->save();

                return redirect('/admin/kardex/all')->with('messages', '??Ingreso guardado con exito!.')
                    ->with('typealert', 'success');
            endif;

            
        endif;
        
    }

    public function getKardexEgress(){

        if(Auth::user()->idmaintenancearea != 0 ):
            $maintenance_areas = MaintenanceArea::where('id', Auth::user()->idmaintenancearea)->get();
            $kardex = Kardex::where('stock', '>', '0')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->get();
        else:
            $maintenance_areas = MaintenanceArea::get();
            $kardex = Kardex::where('stock', '>', '0')->get();
        endif;

        

        $data = [
            'kardex' => $kardex,
            'maintenance_areas' => $maintenance_areas
        ];

        return view('admin.kardex.egress',$data);
    }

    public function postKardexEgress(Request $request){
        $rules = [
            'no_doc' => 'required',
            'idsupplier' => 'required'
        ];

        $messages = [
            'no_doc.required' => 'Se requiere un numero para el documento de egreso.',
            'idsupplier.required' => 'Se requiere que selecciones un area de mantenimiento para registrar el egreso.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '??Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
          
            DB::beginTransaction();

            $ingreso = new EgressKardex;
            $ingreso->id=$request->get('id');
            $ingreso->idmaintenancearea =$request->get('idsupplier');
            $ingreso->type_doc=$request->get('type_doc');
            $ingreso->no_doc=$request->get('no_doc');
            $ingreso->accountable=e($request->get('accountable'));
            $ingreso->ibm_accountable=e($request->get('ibm-accountable'));
            $ingreso->save();

            $idarticulo=$request->get('idarticulo');
            $cantidad=$request->get('cantidad');

            $cont=0;

            while ($cont<count($idarticulo)) {
                $detalle=new EgressDetailKardex();
                $detalle->idegress=$ingreso->id;
                $detalle->idproduct=$idarticulo[$cont];
                $detalle->amount=$cantidad[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();
           

            if($ingreso->save()):
                $b = new Bitacora;
                $b->action = "Registro de egreso de kardex, documento no. ".$ingreso->code_ppr;
                $b->user_id = Auth::id();
                $b->save();

                return redirect('/admin/kardex/all')->with('messages', '??Egreso guardado con exito!.')
                    ->with('typealert', 'success');
            endif;

            
        endif;
        
    }

    public function getKardexRecord($id){

        $kardex = Kardex::findOrFail($id);
            $incomes_details_kardex = IncomeDetailKardex::get();
            $egress_details_kardex = EgressDetailKardex::get();
        $idproduct = $id;

        $data = [
            'kardex' => $kardex,
            'incomes_details_kardex' => $incomes_details_kardex,
            'egress_details_kardex' => $egress_details_kardex,
            'idproduct' => $idproduct
        ];

        return view('admin.kardex.record',$data);
    }

}
