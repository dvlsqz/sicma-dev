<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon, Auth, Validator, Str, Config, Session, DB, Response, File, Image, PDF;

use App\Http\Models\Ots, App\Http\Models\MaintenanceArea,  App\Http\Models\Bitacora, App\User;

class OtController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){
        $ots = Ots::orderBy('id', 'Asc')->get();
                
        

        $data = [
            'ots' => $ots
        ];

    	return view('admin.ot.home', $data);
    }

    public function getOtAdd(){

        if(Auth::user()->idmaintenancearea != 0 ):
            $maintenance_areas = MaintenanceArea::where('id', Auth::user()->idmaintenancearea)->get();
        else:
            $maintenance_areas = MaintenanceArea::get();
        endif;
        
        $data = [
            'maintenance_areas' => $maintenance_areas
        ];

        return view('admin.ot.add', $data);
    }

    public function postOtAdd(Request $request){
        $rules = [
            
        ];

        $messages = [
            
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $o = new Ots;
            $o->id =  $request->input('id');
            $o->idapproval = $request->input('idapproval');
            $o->idmaintenancearea = $request->input('idmaintenancearea');
            $o->date_request = $request->input('date_request');
            $o->correlative = $this->GenerateCorrelative();
            $o->type_work = $request->input('type_work');
            $o->priority = $request->input('priority'); 
            $o->specify_job = e($request->input('specify_job'));            
            $o->status =  "0";

            if($o->save()):

                $b = new Bitacora;
                $b->action = "Registro de Orden de Trabajo";
                $b->user_id = Auth::id();
                $b->save();
                return redirect('/admin/ot')->with('messages', '¡Orden de Trabajo registrada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function GenerateCorrelative(){
        $year = Carbon::now()->year;
        $c_anterior = Ots::whereYear('created_at', $year)->withTrashed()->count();

        if($c_anterior != '0'):
            $c = $c_anterior + 1; //Si hay solicitudes registradas con la misma informacion.
        else:
            $c = 1; //Si no hay solicitudes registradas, se inicia el correlativo.
        endif;

        if(strlen($c) == 1):
            $c = '00'.$c;
        elseif(strlen($c) == 2):
            $c = '0'.$c;
        endif;

        $correlativo = $c.'-'.$year;

        return $correlativo;
    }

    public function getOtAssignmentsPersonal($id){
        $ot = Ots::findOrFail($id);

        $data = [
            'ot' => $ot
        ];

        return view('admin.ot.assignments_personal', $data);
    }
}
