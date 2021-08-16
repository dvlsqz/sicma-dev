<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Illuminate\Support\Collection;
use App\Http\Models\Product, App\Http\Models\Supplier, App\Http\Models\MaintenanceArea, App\Http\Models\IncomeProduct, App\Http\Models\IncomeDetailProduct, App\Http\Models\EgressProduct, App\Http\Models\EgressDetailProduct ,App\Http\Models\Bitacora;
use Validator, Str, Config, Auth, Session, DB, Response;
use Yajra\DataTables\DataTables;


class ProductController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getProduct($status){
        switch ($status) {
            case '0':
                $product = Product::where('type', '0')->orderBy('id', 'Asc')->get();
            break;

            case '1':
                $product = Product::where('type', '1')->orderBy('id', 'Asc')->paginate(25);
            break;

            case '2':
                $product = Product::where('type', '2')->orderBy('id', 'Asc')->paginate(25);
            break;

            case 'trash':
                $product = Product::onlyTrashed()->orderBy('id', 'Asc')->paginate(25);
            break;
        }

        $data = [
            'product'=>$product
        ];

        return view('admin.product.home_filter',$data);
    }

    public function index(){        
        return view('admin.product.home');
    }
    
    public function getProductAll(Request $request){
        
        if ($request->ajax()) {
           $data = Product::latest()->get();        
            
           return DataTables::of($data)     
                   ->addColumn('action', function($row){     
                       $btn = "<a href='/admin/product/$row->id/edit' class='btn btn-light btn-sm' style='margin-right: 4px;' title='Editar'><i class='fas fa-edit' style='color: #256B92;'></i></a>";
                        $btn = $btn."<a href='/admin/product/$row->id/record' class='btn btn-light btn-sm' title='Historial de Movimientos'><i class='fas fa-history'></i></a>";
                       return $btn;        
                   })        
                    ->rawColumns(['action']) 
                    ->make(true);   
        }
    }

    public function getProductAdd(Request $request){
        $data = [

        ];

        return view('admin.product.add',$data);
    }

    public function postProductAdd(Request $request){
        $rules = [
            'code_ppr' => 'required',
            'name' => 'required',
        ];

        $messages = [
            'code_ppr.required' => 'Se requiere un codigo ppr para el producto.',
            'name.required' => 'Se require un nombre para el producto.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $p = new Product;
            $p->code_ppr =  $request->input('code_ppr');
            $p->name = e($request->input('name'));
            $p->stock = '0';
            $p->presentation = e($request->input('presentation'));
            $p->price_unit = $request->input('price_unit');
            $p->type = $request->input('type');
            $p->date_prod = $request->input('date_prod');
            $p->date_ven = $request->input('date_ven');            
            $p->description = e($request->input('description'));
            $p->status =  '1';

            if($p->save()):
                $b = new Bitacora;
                $b->action = "Creaciòn de producto ".$p->code_ppr;
                $b->user_id = Auth::id();
                $b->save();

                return redirect('/admin/products/all')->with('messages', '¡Insumo registrado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;

    }

    public function getProductEdit($id){

        $product = Product::findOrFail($id);
        $incomes_details_products = IncomeDetailProduct::get();
        $egress_details_products = EgressDetailProduct::get();
        $idproduct = $id;

        $data = [
            'product' => $product,
            'incomes_details_products' => $incomes_details_products,
            'egress_details_products' => $egress_details_products,
            'idproduct' => $idproduct
        ];

        return view('admin.product.edit',$data);
    }

    public function postProductEdit(Request $request, $id){
        $rules = [
            'code_ppr' => 'required',
            'name' => 'required',
            'stock' => 'required'
        ];

        $messages = [
            'code_ppr.required' => 'Se requiere un codigo ppr para el producto.',
            'name.required' => 'Se require un nombre para el producto.',
            'stock.required' => 'Se require un stock para el producto.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $p = Product::findOrFail($id);
            $p->name = e($request->input('name'));
            $p->stock = $request->input('stock');
            $p->presentation = e($request->input('presentation'));
            $p->price_unit = $request->input('price_unit');
            $p->date_prod = $request->input('date_prod');
            $p->date_ven = $request->input('date_ven');
            $p->type = $request->input('type');
            $p->description = e($request->input('description'));
            $p->status =  '1';

            if($p->save()):
                $b = new Bitacora;
                $b->action = "Actualización de datos de insumo ".$p->code_ppr;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Insumo editado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;

    }

    public function getProductIncome(){
        $suppliers = Supplier::get();
        $products = Product::get();
 
        $data = [
            'suppliers' => $suppliers,
            'products' => $products
        ];

        return view('admin.product.income',$data);
    }

    public function postProductIncome(Request $request){
        $rules = [
            'no_doc' => 'required'
        ];

        $messages = [
            'no_doc.required' => 'Se requiere un numero para el documento de ingreso.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
          
            DB::beginTransaction();

            $ingreso = new IncomeProduct;
            $ingreso->id=$request->get('id');
            $ingreso->idsupplier=$request->get('idproveedor');
            $ingreso->type_doc=$request->get('tipo_comprobante');
            $ingreso->serie_doc=$request->get('serie_doc');
            $ingreso->no_doc=$request->get('no_doc');
            $ingreso->no_siaf=$request->get('no_siaf');
            $ingreso->no_oc=$request->get('no_oc');
            $ingreso->save();

            $idarticulo=$request->get('idarticulo');
            $cantidad=$request->get('cantidad');

            $cont=0;

            while ($cont<count($idarticulo)) {
                $detalle=new IncomeDetailProduct();
                $detalle->idincome=$ingreso->id;
                $detalle->idproduct=$idarticulo[$cont];
                $detalle->amount=$cantidad[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();
           

            if($ingreso->save()):
                $b = new Bitacora;
                $b->action = "Registro de ingreso de insumos, documento no. ".$ingreso->code_ppr;
                $b->user_id = Auth::id();
                $b->save();

                return redirect('/admin/products/all')->with('messages', '¡Ingreso registrado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;

            
        endif;
        
    }

    public function getProductEgress(){
        $maintenance_areas = MaintenanceArea::get();
        $products = Product::where('stock', '>', '0')->get();

        $data = [
            'maintenance_areas' => $maintenance_areas,
            'products' => $products
        ];

        return view('admin.product.egress',$data);
    }

    public function postProductEgress(Request $request){
        $rules = [
            'no_doc' => 'required'
        ];

        $messages = [
            'no_doc.required' => 'Se requiere un numero para el documento de ingreso.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
          
            DB::beginTransaction();

            $egreso = new EgressProduct;
            $egreso->id=$request->get('id');
            $egreso->idmaintenancearea =$request->get('idproveedor');
            $egreso->type_doc=$request->get('tipo_comprobante');
            $egreso->no_doc=$request->get('no_doc');
            $egreso->save();

            $idarticulo=$request->get('idarticulo');
            $cantidad=$request->get('cantidad');

            $cont=0;

            while ($cont<count($idarticulo)) {
                $detalle=new EgressDetailProduct();
                $detalle->idegress=$egreso->id;
                $detalle->idproduct=$idarticulo[$cont];
                $detalle->amount=$cantidad[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();
           

            if($egreso->save()):
                $b = new Bitacora;
                $b->action = "Registro de egreso de insumos, documento no. ".$egreso->code_ppr;
                $b->user_id = Auth::id();
                $b->save();

                return redirect('/admin/products/all')->with('messages', '¡Egreso registrado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;

            
        endif;
        
    }

    public function getProductRecord($id){
        $incomes_details_products = IncomeDetailProduct::get();
        $egress_details_products = EgressDetailProduct::get();
        $idproduct = $id;

        $data = [
            'incomes_details_products' => $incomes_details_products,
            'egress_details_products' => $egress_details_products,
            'idproduct' => $idproduct
        ];

        return view('admin.product.record',$data);
    }
}
