<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon, Auth, Validator, Str, Config, Session, DB, Response, File, Image, PDF;

use App\Http\Models\Ots, App\Http\Models\OtsAssignmentsPersonal, App\Http\Models\OtsFG, App\Http\Models\MaintenanceArea, App\Http\Models\EgressKardex, App\Http\Models\EgressDetailKardex,  App\Http\Models\Bitacora, App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

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
            $o->idapplicant = Auth::user()->id;
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

    public function postOtAssignmentsPersonal(Request $request, $id){
        $rules = [

        ];

        $messages = [

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $o = new OtsAssignmentsPersonal;
            $o->id =  $request->input('id');
            $o->idots = $id;
            $o->type_personal = $request->input('type_personal');
            $o->company = e($request->input('company'));
            $o->name = e($request->input('name'));
            $o->area = e($request->input('area'));
            $o->date = $request->input('date');
            $o->hour = $request->input('hour');

            if($o->save()):

                $b = new Bitacora;
                $b->action = "Asingacion de Personal a OT";
                $b->user_id = Auth::id();
                $b->save();
                return redirect('/admin/ot')->with('messages', '¡Asignacion de Personal registrada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getOtAcceptReject($id, $arm){

        $o = Ots::findOrFail($id);

        if($arm == "1"):
            $o->status = '1';
        elseif($arm == "2"):
            $o->status = '100';
        endif;

        if($o->save()):

            $b = new Bitacora;
            if($arm == "1"):
                $b->action = "Solicitud de OT Autorizada.";
            elseif($arm == "2"):
                $b->action = "Solicitud de OT Rechazada.";
            endif;

            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡OT Autorizada o Rechazada con exito!.')
                    ->with('typealert', 'success');
        endif;

    }

    public function getOtPrint($id){
        $ots = Ots::findOrFail($id);

        $data = [
            'ots' => $ots
        ];

        $pdf = PDF::loadView('admin.ot.print',$data)->setPaper('a4', 'portrait');
        return $pdf->stream('OT.pdf');
    }

    public function getOtMaterials($id){
        $egress = EgressDetailKardex::with(['egress'])->get();
        $ot = Ots::findOrFail($id);

        $data = [
            'ot' => $ot,
            'egress' => $egress
        ];

        return view('admin.ot.materials', $data);
    }

    public function getOtFiles($id){
        $ot = Ots::findOrFail($id);
        $files = OtsFG::where('idots', $id)->where('type_file', '0')->get();
        $gallery = OtsFG::where('idots', $id)->where('type_file', '1')->get();

        $data = [
            'ot' => $ot,
            'files' => $files,
            'gallery' => $gallery
        ];

        return view('admin.ot.files',$data);
    }

    public function postOtUploadFile(Request $request, $id){
        $rules = [
            'file_name' => 'required',
            'file_name.*' => 'required|file|mimes:pdf,docx,doc|max:5000|',
        ];

        $messages = [
            'file_name.required' => 'Se requiere que seleccione un documento.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', '¡Se ha producido un error!.')
            ->withInput();
        else:

            if($request->hasFile('file_name')):

                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('file_name')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads_files.root');
                $name = Str::slug(str_replace($fileExt, ' ',$request->file('file_name')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;

                //Storage::disk('ftp')->put($filename, fopen($request->file('file_name'), 'r+'));

                $ef = new OtsFG;
                $ef->idots = $id;
                $ef->file_path = date('Y-m-d');
                $ef->file_name = $filename;
                $ef->description = e($request->input('description'));
                $ef->type_file = "0";

                if($ef->save()):
                    if($request->hasFile('file_name')):
                        $fl = $request->file('file_name')->storeAs($path, $filename, 'uploads_files');
                    endif;
                    $b = new Bitacora;
                    $b->action = "Carga de archivo ".$ef->file_name." de la OT No. ".$ef->ot->correlative;
                    $b->user_id = Auth::id();
                    $b->save();

                    return back()->with('messages', '¡Archivo subido con exito.!')
                        ->with('typealert', 'success');
                endif;

            endif;
        endif;
    }

    public function postOtUploadImage(Request $request, $id){
        $rules = [
            'file_name.*' => 'required|image|max:5000|mimes:pdf,docx,doc',
        ];

        $messages = [
            'file_name.required' => 'Se requiere que seleccione un documento.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', '¡Se ha producido un error!.')
            ->withInput();
        else:

            if($request->hasFile('file_image')):

                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads_photos.root');
                $name = Str::slug(str_replace($fileExt, ' ',$request->file('file_image')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;

                $ef = new OtsFG;
                $ef->idots = $id;
                $ef->file_path = date('Y-m-d');
                $ef->file_name = $filename;
                $ef->description = e($request->input('description'));
                $ef->type_file = "1";


                if($ef->save()):
                    if($request->hasFile('file_image')):
                        $fl = $request->file_image->storeAs($path, $filename, 'uploads_photos');
                        $img = Image::make($file_file);
                        $img->fit(256,256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;

                    $b = new Bitacora;
                    $b->action = "Carga de foto ".$ef->file_name." del ING No. ".$ef->ot->correlative;
                    $b->user_id = Auth::id();
                    $b->save();

                    return back()->with('messages', '¡Foto subida con exito.!')
                        ->with('typealert', 'success');
                endif;

            endif;
        endif;
    }
}
