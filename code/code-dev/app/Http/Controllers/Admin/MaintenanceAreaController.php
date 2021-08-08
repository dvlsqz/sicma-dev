<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\MaintenanceArea, App\Http\Models\Bitacora, App\Http\Models\Unit;
use Validator, Str, Config, Auth;

class MaintenanceAreaController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){

        $maintenance_areas = MaintenanceArea::orderBy('name', 'Asc')->paginate(15);
        $units = Unit::pluck('name', 'id');

        $data = [
            'maintenance_areas' => $maintenance_areas,
            'units' => $units
        ];

        return view('admin.maintenance_areas.home', $data);
    }

    public function postMaintenanceAreaAdd(Request $request){
    	$rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el area de mantenimiento.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else: 

            $ma = new MaintenanceArea;
            $ma->code = e($request->input('code'));
            $ma->name = e($request->input('name'));
            $ma->unit_id = $request->input('unit_id');
            
            if($ma->save()):
                $b = new Bitacora;
                $b->action = "Creación de area de mantenimiento: ".$ma->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Area creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
    	endif;
    }

    public function getMaintenanceAreaEdit($id){
        $ma = MaintenanceArea::find($id);
        $units = Unit::pluck('name', 'id');

        $data = [
            'ma' => $ma,
            'units' => $units
        ];

        return view('admin.maintenance_areas.edit', $data);
    }

    public function postMaintenanceAreaEdit(Request $request, $id){
        $rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el area de mantenimiento.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else: 
            

            $ma = MaintenanceArea::find($id);
            $ma->code = e($request->input('code'));
            $ma->name = e($request->input('name'));
            $ma->unit_id = $request->input('unit_id');
            
            if($ma->save()):
                $b = new Bitacora;
                $b->action = "Actualizaciòn de datos de area de mantenimiento: ".$ma->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Area actualizada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
    	endif;
    }

    public function getMaintenanceAreaDelete($id){
        $ma = MaintenanceArea::find($id);

        if($ma->delete()):
            
            $b = new Bitacora;
            $b->action = "Eliminación de área de mantenimiento: ".$ma->name;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Area borrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
