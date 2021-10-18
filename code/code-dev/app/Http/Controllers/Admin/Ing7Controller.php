<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon, Auth, Validator, Str, Config, Session, DB, Response, File, Image, PDF;

use App\Http\Models\Ings7, App\Http\Models\Ings7AssignmentArea, App\Http\Models\Ings7AssignmentPersonal, App\Http\Models\Ings7Follow, App\Http\Models\MaintenanceArea,  App\Http\Models\Bitacora, App\Http\Models\EgressKardex, App\Http\Models\EgressDetailKardex, App\User;
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

    public function getHome($status){
        /*if(Auth::user()->role == "0" || Auth::user()->role == "6"):
            $ings7 = Ings7::orderBy('id', 'Asc')->get();
        elseif(Auth::user()->role == "7"):
            $ings7 = Ings7::where('status', '1')->orderBy('id', 'Asc')->get();
        endif;*/

        switch ($status) {
            case '1':
                if(Auth::user()->role == "2"):
                    $ings7 = Ings7::orderBy('id', 'Asc')->get();
                    $ings7aa = Ings7AssignmentArea::where('idmaintenancearea', Auth::user()->idmaintenancearea)->get();
                else:
                    $ings7 = Ings7::orderBy('id', 'Asc')->get();
                    $ings7aa = "";
                endif;
            break;

            case 'trash':
                $ings7 = Ings7::onlyTrashed()->orderBy('id', 'Asc')->get();
                $ings7aa = "";
            break;
        }

        $data = [
            'ings7' => $ings7,
            'ings7aa' => $ings7aa
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
                $b->action = "Registro de solicitud ING-7";
                $b->user_id = Auth::id();
                $b->iding7 = $i->id;
                $b->save();
                return redirect('/admin/ing_7/1')->with('messages', '¡Solicitud registrada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function GenerateCorrelative(){
        $year = Carbon::now()->year;
        $c_anterior = Ings7::whereYear('created_at', $year)->withTrashed()->count();

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

        $i = Ings7::findOrFail($id);
        $i->print = '1';
        $i->status = '1';

        if($i->save()):

            $b = new Bitacora;
            $b->action = "Impresion de solicitud y traslado a firma";
            $b->user_id = Auth::id();
            $b->iding7 = $i->id;
            $b->save();
        endif;

        $data = [
            'ings7' => $ings7
        ];

        $pdf = PDF::loadView('admin.ing7.print',$data)->setPaper('legal', 'portrait');
        return $pdf->stream('ING-7.pdf');
    }

    public function getIng7PrintFollow($id){
        $ings7 = Ings7::findOrFail($id);

        $data = [
            'ings7' => $ings7
        ];

        $pdf = PDF::loadView('admin.ing7.print_follow',$data)->setPaper('legal', 'portrait');
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
        $ing7f = Ings7Follow::where('iding7',$id)->get();
        $ing7 = Ings7::findOrFail($id);

        $data = [
            'ing7f' => $ing7f,
            'ing7' => $ing7
        ];

        return view('admin.ing7.follow', $data);
    }

    public function postIng7Follow(Request $request, $id){
        $rules = [

        ];

        $messages = [

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $i = new Ings7Follow;
            $i->id =  $request->input('id');
            $i->iding7 = $id;
            $i->date = $request->input('date');
            $i->action = $request->input('action');
            $i->iduser = Auth::user()->id;

            if($i->save()):

                $b = new Bitacora;
                $b->action = "Llenado de ficha de seguimiento";
                $b->user_id = Auth::id();
                $b->iding7 = $i->id;
                $b->save();
                return back()->with('messages', '¡Acción de seguimiento registrada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
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
                $i = Ings7::findOrFail($in->iding7);
                $status_a = $i->status;

                if($status_a = '2'):
                    $i->status = '3';
                else:
                    $i->status = $status_a;
                endif;

                $i->save();

                $b = new Bitacora;
                $b->action = "Asignacion de area de trabajo. ";
                $b->user_id = Auth::id();
                $b->iding7 = $in->iding7;
                $b->save();
                return back()->with('messages', '¡Asignacion registrada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getIng7AssignmentsPersonal($id){
        $ing7 = Ings7::findOrFail($id);
        $iap = Ings7AssignmentPersonal::where('iding7', $id )->get();
        $users = User::where('status','!=','0')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->get();

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
                $i = Ings7::findOrFail($in->iding7);
                $status_a = $i->status;

                if($status_a == '3'):
                    $i->status = '4';
                else:
                    $i->status = $status_a;
                endif;

                $i->save();

                $b = new Bitacora;
                $b->action = "Asignacion de personal para realizar trabajo. ";
                $b->user_id = Auth::id();
                $b->iding7 = $in->iding7;
                $b->save();
                return back()->with('messages', '¡Asignacion registrada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getIng7Record($id){
        $bitacoras = Bitacora::with(['user','ing7'])->where('iding7',$id)->orderBy('id', 'ASC')->get();

        $data = [
            'bitacoras' => $bitacoras
        ];

        return view('admin.ing7.record', $data);
    }

    public function getIng7ReceiveReject($id, $rrs){
        $i = Ings7::findOrFail($id);

        if($rrs == "1"):
            $i->status = '2';
        elseif($rrs == "2"):
            $i->status = '110';
        endif;

        if($i->save()):

            $b = new Bitacora;
            if($rrs == "1"):
                $b->action = "Recepcionado por secretaria de mantenimiento.";
            elseif($rrs == "2"):
                $b->action = "Rechazado por secretaria de mantenimiento.";
            endif;

            $b->user_id = Auth::id();
            $b->iding7 = $i->id;
            $b->save();

            return back()->with('messages', '¡ING-7 recepcionado o rechazado con exito!.')
                    ->with('typealert', 'success');
        endif;
    }

    public function getIng7AnAudit($id){
        $i = Ings7::findOrFail($id);
        $i->status = '5';

        if($i->save()):

            $b = new Bitacora;
            $b->action = "En revisión por personal asignado.";
            $b->user_id = Auth::id();
            $b->iding7 = $i->id;
            $b->save();

            return back()->with('messages', '¡ING-7 en revision con exito!.')
                    ->with('typealert', 'success');
        endif;

    }

    public function getIng7Delete($id){

        $i = Ings7::findOrFail($id);
        $i->status = '100';
        $i->save();

        if($i->delete()):

            $b = new Bitacora;
            $b->action = "Solicitud anulada.";
            $b->user_id = Auth::id();
            $b->iding7 = $i->id;
            $b->save();

            return back()->with('messages', '¡ING-7 anulada con exito!.')
                    ->with('typealert', 'success');
        endif;

    }

    public function getIng7AcceptReject($id, $ara, $comment){
        $i = Ings7::findOrFail($id);

        if($ara == "1"):
            $i->status = "6";
        elseif($ara == "2"):
            $i->status = "7";
        endif;

        if($i->save()):

            $b = new Bitacora;

            if($i->status == '6'):
                $b->action = "Solicitud Verificada y Aceptada.";
            else:
                $b->action = "Solicitud Verificada y Rechazada.";
            endif;

            $b->user_id = Auth::id();
            $b->iding7 = $i->id;

            if($comment != "1"):
                $b->comment = e($comment);
            endif;

            $b->save();

            return back()->with('messages', '¡ING-7 aceptada y/o rechazada con exito!.')
                    ->with('typealert', 'success');
        endif;

    }

    public function getIng7InAction($id){
        $i = Ings7::findOrFail($id);
        $i->status = '8';

        if($i->save()):

            $b = new Bitacora;
            $b->action = "En proceso de ejecucion.";
            $b->user_id = Auth::id();
            $b->iding7 = $i->id;
            $b->save();

            return back()->with('messages', '¡ING-7 en ejecucion con exito!.')
                    ->with('typealert', 'success');
        endif;

    }

    public function getIng7Finish($id){
        $i = Ings7::findOrFail($id);
        $i->status = '9';

        if($i->save()):

            $b = new Bitacora;
            $b->action = "Trabajo(s) de solicitud terminado(s).";
            $b->user_id = Auth::id();
            $b->iding7 = $i->id;
            $b->save();

            return back()->with('messages', '¡ING-7 terminado con exito!.')
                    ->with('typealert', 'success');
        endif;

    }

    public function getIng7Materials($id){
        $egress = EgressDetailKardex::with(['egress'])->get();
        $ing7 = Ings7::findOrFail($id);

        $data = [
            'ing7' => $ing7,
            'egress' => $egress
        ];

        return view('admin.ing7.materials', $data);
    }

}
