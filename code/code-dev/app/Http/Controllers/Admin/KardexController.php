<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Kardex, App\Http\Models\Product, App\Http\Models\MaintenanceArea, App\Http\Models\Bitacora, App\Http\Models\IncomeKardex, App\Http\Models\IncomeDetailKardex, App\Http\Models\EgressKardex, App\Http\Models\EgressDetailKardex, App\Http\Models\Ings7, App\Http\Models\Ots, App\User;
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
                    $kardex = Kardex::where('type', '0')->orderBy('id', 'Asc')->get();
                break;

                case '1':
                    $kardex = Kardex::where('type', '1')->orderBy('id', 'Asc')->get();
                break;

                case '2':
                    $kardex = Kardex::where('type', '2')->orderBy('id', 'Asc')->get();
                break;

                case '3':
                    $kardex = Kardex::where('type', '3')->orderBy('id', 'Asc')->get();
                break;

                case 'all':
                    $kardex = Kardex::orderby('id','Asc')->get();
                break;

                case 'trash':
                    $kardex = Kardex::onlyTrashed()->orderBy('id', 'Asc')->get();
                break;
            }
        else:
            switch ($status) {
                case '0':
                    $kardex = Kardex::where('type', '0')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->get();
                break;

                case '1':
                    $kardex = Kardex::where('type', '1')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->get();
                break;

                case '2':
                    $kardex = Kardex::where('type', '2')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->get();
                break;

                case '3':
                    $kardex = Kardex::where('type', '3')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->get();
                break;

                case 'all':
                    $kardex = Kardex::where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderby('id','Asc')->get();
                break;

                case 'trash':
                    $kardex = Kardex::onlyTrashed()->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->get();
                break;
            }
        endif;

        $incomes_kardex = IncomeKardex::where('idmaintenancearea', Auth::user()->idmaintenancearea)->get();
        $incomes_details_kardex = IncomeDetailKardex::get();

        $data = [
            'kardex'=>$kardex,
            'incomes_kardex' => $incomes_kardex,
            'incomes_details_kardex' => $incomes_details_kardex
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
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
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
                return redirect('/admin/kardex/all')->with('messages', '¡Registro de Producto en Kardex Guardado con exito!.')
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
            return back()->withErrors($validator)->with('error', '¡Se ha producido un error!.')
            ->withInput();
        else:

            $k = Kardex::findOrFail($id);
            $k->observations =  $request->input('observations');

            if($k->save()):
                $b = new Bitacora;
                $b->action = "Actualizacion de insumo ".$k->code_mantto_int." a kardex de area ".$k->area->name;
                $b->user_id = Auth::id();
                $b->save();
                Session::flash('success', '¡Producto guardado con exito!.');
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

        $users = User::where('status','!=','0')->get();

        $data = [
            'kardex' => $kardex,
            'maintenance_areas' => $maintenance_areas,
            'users' => $users
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
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            DB::beginTransaction();

            $ingreso = new IncomeKardex;
            $ingreso->id=$request->get('id');
            $ingreso->idmaintenancearea=$request->get('idsupplier');
            $ingreso->type_doc=$request->get('type_doc');
            $ingreso->no_doc=$request->get('no_doc');
            $ingreso->idaccountable=$request->get('iduser');
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

                return redirect('/admin/kardex/all')->with('messages', '¡Ingreso guardado con exito!.')
                    ->with('typealert', 'success');
            endif;


        endif;

    }

    public function getKardexEgress(){

        if(Auth::user()->idmaintenancearea != 0 ):
            $maintenance_areas = MaintenanceArea::where('id', Auth::user()->idmaintenancearea)->get();
            $kardex = Kardex::where('stock', '>', '0')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->get();
            $ings = Ings7::where('status', '6')->orWhere('status', '8')->pluck('correlative', 'id');
            /*$ings = Ings7::with(['ings7a', function (){
                return $query->where('idmaintenancearea', '=', Auth::user()->idmaintenancearea);
            }])->pluck('correlative','id');
            $ings_all = Ings7::where('status', '6')->orWhere('status', '8')->get();
            $ings = $ings_all->ings7a()->where('idmaintenancearea', Auth::user()->idmaintenancearea)->pluck('correlative', 'id');*/
            $ots = Ots::where('status', '1')->pluck('correlative', 'id');
        else:
            $maintenance_areas = MaintenanceArea::get();
            $kardex = Kardex::where('stock', '>', '0')->get();
            $ings = Ings7::where('status', '6')->pluck('correlative', 'id');
            $ots = Ots::where('status', '1')->pluck('correlative', 'id');
        endif;

        $users = User::where('status','!=','0')->get();

        $data = [
            'kardex' => $kardex,
            'maintenance_areas' => $maintenance_areas,
            'ings' => $ings,
            'ots' => $ots,
            'users' => $users
        ];

        return view('admin.kardex.egress',$data);
    }

    public function postKardexEgress(Request $request){
        $rules = [

            'idsupplier' => 'required'
        ];

        $messages = [

            'idsupplier.required' => 'Se requiere que selecciones un area de mantenimiento para registrar el egreso.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            DB::beginTransaction();

            $ingreso = new EgressKardex;
            $ingreso->id=$request->get('id');
            $ingreso->idmaintenancearea =$request->get('idsupplier');
            $ingreso->type_doc=$request->get('type_doc');

            if($request->get('type_doc') == '0'):
                $ingreso->iding7 = $request->get('iding7');
            elseif($request->get('type_doc') == '1'):
                $ingreso->idot = $request->get('idot');
            else:
                $ingreso->no_doc=$request->get('no_doc');
            endif;

            $ingreso->idaccountable=$request->get('iduser');
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

                return redirect('/admin/kardex/all')->with('messages', '¡Egreso guardado con exito!.')
                    ->with('typealert', 'success');
            endif;


        endif;

    }

    public function getKardexRecord($id){

        $kardex = Kardex::findOrFail($id);
        $incomes_details_kardex = IncomeDetailKardex::get();
        $egress_details_kardex = EgressDetailKardex::with(['egress'])->where('idproduct', $id)->get();
        $idproduct = $id;



        $data = [
            'kardex' => $kardex,
            'incomes_details_kardex' => $incomes_details_kardex,
            'egress_details_kardex' => $egress_details_kardex,
            'idproduct' => $idproduct
        ];

        return view('admin.kardex.record',$data);
    }

    public function postKardexDabSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El campo consulta es requerido.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return redirect('/admin/kardex/all')->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
            $dab = IncomeKardex::where('no_doc','LIKE', '%'.$request->input('search').'%')->limit(1)->get();
            $dab_det = IncomeDetailKardex::all();



            $data = [
                'dab' => $dab,
                'dab_det' => $dab_det
            ];

            return view('admin.kardex.search', $data);

        endif;
    }

}
