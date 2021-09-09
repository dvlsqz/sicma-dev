<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, Auth, Validator, Str, Config, Session, DB, Response, File, Image, PDF;

use App\Http\Models\Ings7, App\Http\Models\Ings7Follow, App\Http\Models\Ings7AssignmentArea, App\Http\Models\Ings7AssignmentPersonal, App\Http\Models\MaintenanceArea,  App\Http\Models\Bitacora, App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class Ing7Controller extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){
        $ings7 = Ings7::orderBy('id', 'Asc')->get();

        $data = [
            'ings7' => $ings7
        ];

    	return view('admin.ing7.home', $data);
    }

    public function getIng7Add(){ 

        $data = [
            
        ];

    	return view('admin.ing7.add');
    }

    public function postIng7Add(Request $request){
        $rules = [
            
        ];

        $messages = [
            
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $i = new Ings7;
            $i->id =  $request->input('id');
            $i->managed = $request->input('managed');
            $i->administrative_key = '090103';
            $i->idservice = Auth::user()->idservice;
            $i->correlative = $this->GenerateCorrelative();
            $i->description = $request->input('description');
            $i->idapplicant = Auth::user()->id;            
            $i->status =  "0";

            if($i->save()):
                $b = new Bitacora;
                $b->action = "Registro de solicitud de ING-7 no. ".$i->correlative;
                $b->user_id = Auth::id();
                $b->save();
                return redirect('/admin/ing_7')->with('messages', '¡Solicitud registrada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function GenerateCorrelative(){
        $year = Carbon::now()->year;
        $c_anterior = Ings7::whereYear('created_at', $year)->count();

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

        $correlativo = $c.'/'.$year;

        return $correlativo;
    }

    public function getIng7Digital($id){
        $ings7 = Ings7::findOrFail($id);
        
        $data = [
            'ings7' => $ings7
        ];

        $pdf = PDF::loadView('admin.ing7.print',$data)->setPaper('legal', 'portrait');
        return $pdf->stream('ING-7.pdf');
    }

    public function getIng7Print($id){
        $ings7 = Ings7::findOrFail($id);
        
        $data = [
            'ings7' => $ings7
        ];

        $pdf = PDF::loadView('admin.ing7.print',$data)->setPaper('legal', 'portrait');
        return $pdf->stream('ING-7.pdf');
    }

    public function getIng7Classification($id){
        $ing7 = Ings7::findOrFail($id);
        
        $data = [
            'ing7' => $ing7
        ];

        return view('admin.ing7.classification', $data);
    }

    public function postIng7ClassificationTypeWork(Request $request, $id){
        $i = Ings7::findOrFail($id);

        $a = collect($request->only('type_work'));
        $i->type_work = $request->except(['_token']);

        if($i->save()):
            $b = new Bitacora;
            $b->action = "Registro de clasificacion de tipo de trabajo de ING-7 no.: ".$i->correlative;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages','¡Clasificación registrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function postIng7ClassificationAreaWork(Request $request, $id){
        $i = Ings7::findOrFail($id);        

        $a = collect($request->only('type_work'));
        $i->area_work = $request->except(['_token']);
               
        if($i->save()):
            $b = new Bitacora;
            $b->action = "Registro de clasificacion de area de trabajo de ING-7 no.: ".$i->correlative;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages','¡Clasificación registrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getIng7ClassificationBuyHire($id){
        $ing7 = Ings7::findOrFail($id);
        
        $data = [
            'ing7' => $ing7
        ];

        return view('admin.ing7.buy_hire', $data);
    }

    public function postIng7ClassificationBuyHire(Request $request, $id){
        $i = Ings7::findOrFail($id); 
        $i->buy_materials = $request->input('buy_materials');
        $i->hire_jobs = $request->input('hire_jobs');
               
        if($i->save()):
            $b = new Bitacora;
            $b->action = "Registro de clasificacion de compra o contratación de ING-7 no.: ".$i->correlative;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages','¡Clasificación registrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getIng7Follow($id){
        $ing7 = Ings7::findOrFail($id);
        
        $data = [
            'ing7' => $ing7
        ];

        return view('admin.ing7.follow', $data);
    }

    public function getIng7AssignmentsAreas($id){
        $ing7 = Ings7::findOrFail($id);
        $iaa = Ings7AssignmentArea::where('iding7', $id )->get();
        $maintenance_areas = MaintenanceArea::get();
        
        $data = [
            'ing7' => $ing7,
            'iaa' => $iaa,
            'maintenance_areas' => $maintenance_areas
        ];

        return view('admin.ing7.assignments_areas', $data);
    }

    public function postIng7AssignmentsAreas(Request $request, $id){
        $rules = [
            
        ];

        $messages = [
            
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $in = new Ings7AssignmentArea;
            $in->id =  $request->input('id');
            $in->iding7 = $request->input('iding7');
            $in->idmaintenancearea = $request->input('idmaintenancearea');

            if($in->save()):
                $b = new Bitacora;
                $b->action = "Asignacion de area de trabajo para ING-7 no. ".$in->correlative;
                $b->user_id = Auth::id();
                $b->save();
                return back()->with('messages', '¡Asignacion registrada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getIng7AssignmentsPersonal($id){
        $ing7 = Ings7::findOrFail($id);
        $iap = Ings7AssignmentPersonal::where('iding7', $id )->get();
        $users = User::where('status','!=','0')->get();
        
        $data = [
            'ing7' => $ing7,
            'iap' => $iap,
            'users' => $users
        ];

        return view('admin.ing7.assignments_personal', $data);
    }

    public function postIng7AssignmentsPersonal(Request $request, $id){
        $rules = [
            
        ];

        $messages = [
            
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $in = new Ings7AssignmentPersonal;
            $in->id =  $request->input('id');
            $in->iding7 = $request->input('iding7');
            $in->iduser = $request->input('iduser');

            if($in->save()):
                $b = new Bitacora;
                $b->action = "Asignacion de personal de trabajo para ING-7 no. ".$in->correlative;
                $b->user_id = Auth::id();
                $b->save();
                return back()->with('messages', '¡Asignacion registrada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    

}
