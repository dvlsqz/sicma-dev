<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Supplier, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth;

class SupplierController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){
        $suppliers = Supplier::orderBy('name', 'Asc')->paginate(15);

        $data = [
            'suppliers' => $suppliers
        ];

    	return view('admin.suppliers.home', $data);
    }

    public function getSupplierAdd(){
        $s = Supplier::orderBy('name', 'Asc')->paginate(15);

        $data = [
            's' => $s
        ];

        return view('admin.suppliers.add');
    }

    public function postSupplierAdd(Request $request){
        $rules = [
            'name' => 'required',
            'phone' => 'required'
        ];

        $messages = [
            'name.required' => 'Se require un nombre.',
            'phone.required'=> 'Se requiere un número de teléfono'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $s = new Supplier;
            $s->name = e($request->input('name'));
            $s->nit = e($request->input('nit'));
            $s->name_contact = e($request->input('name_contact'));
            $s->phone = $request->input('phone');
            $s->email = e($request->input('email'));

            if($s->save()):
                $b = new Bitacora;
                $b->action = "Registro de proveedor ".$s->name;
                $b->user_id = Auth::id();
                $b->save();
            
                return redirect('/admin/suppliers')->with('messages', '¡Proveedor registrado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getSupplierEdit($id){

        $supplier = Supplier::findOrFail($id);

        $data = [
            'supplier' => $supplier
        ];

        return view('admin.suppliers.edit',$data);
    }

    public function postSupplierEdit(Request $request, $id){
        $s = Supplier::findOrFail($id);
        $s->name = e($request->input('name'));
        $s->nit = e($request->input('nit'));
        $s->name_contact = e($request->input('name_contact'));
        $s->phone = $request->input('phone');
        $s->email = e($request->input('email'));

        if($s->save()):
            $b = new Bitacora;
            $b->action = "Actualización de informacion de proveedor: ".$s->name;
            $b->user_id = Auth::id();
            $b->save();

            return redirect('/admin/suppliers')->with('messages', '¡Proveedor actualizado y guardado con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
