<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Equipment, App\Http\Models\EquipmentFG, App\Http\Models\EquipmentPart, App\Http\Models\EquipmentConecction, App\Http\Models\EquipmentTransfer, App\Http\Models\Environment, App\Http\Models\MaintenanceArea, App\Http\Models\Supplier, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth, Session, DB, Response, File, Image, PDF, Carbon\Carbon;

class EquipmentController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome($status){
        if(Auth::user()->role == "0"):
            switch ($status) {
                case '0':
                    $environment = Environment::where('status', '0')->orderBy('id', 'Asc')->paginate(25);
                break;

                case '1':
                    $equipment = Equipment::where('status', '1')->orderBy('id', 'Asc')->paginate(25);
                break;

                case 'all':
                    $equipment = Equipment::orderby('id','Asc')->get();
                break;

                case 'trash':
                    $equipment = Equipment::onlyTrashed()->orderBy('id', 'Asc')->paginate(25);
                break;
            }
        else:
            switch ($status) {
                case '0':
                    $environment = Environment::where('status', '0')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->paginate(25);
                break;

                case '1':
                    $equipment = Equipment::where('status', '1')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->orderBy('id', 'Asc')->paginate(25);
                break;

                case 'all':
                    $equipment = Equipment::orderby('id','Asc')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->get();
                break;

                case 'trash':
                    $equipment = Equipment::onlyTrashed()->orderBy('id', 'Asc')->where('idmaintenancearea', Auth::user()->idmaintenancearea)->paginate(25);
                break;
            }

        endif;

        $data = [
            'equipment' => $equipment
        ];

        return view('admin.equipments.home',$data);
    }

    public function getEquipmentAdd(){
        $servicegeneral = Environment::where('parent', '0')->where('status', '0')->pluck('name', 'id');
        $suppliers = Supplier::get();

        if(Auth::user()->idmaintenancearea != 0 ):
            $maintenance_areas = MaintenanceArea::where('id', Auth::user()->idmaintenancearea)->get();
        else:
            $maintenance_areas = MaintenanceArea::get();
        endif;

        $data = [
            'maintenance_areas' => $maintenance_areas,
            'suppliers' => $suppliers,
            'servicegeneral' => $servicegeneral
        ];

        return view('admin.equipments.add',$data);
    }

    public function postEquipmentAdd(Request $request){

        $rules = [

        ];

        $messages = [

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:



            $e = new Equipment;
            $e->id =  $request->input('id');
            $e->idmaintenancearea =  $request->input('idmaintenancearea');
            $e->idsupplier =  $request->input('idsupplier');
            $e->code_old = $request->input('code_old');
            if(Auth::user()->role == "0"):
                $e->code_new =  $this->GenerateCode($request->input('idmaintenancearea'),$request->input('environment'), $request->input('name'),$request->input('idmaintenancearea'));
            else:
                $e->code_new =  $this->GenerateCode($request->input('idmaintenancearea'),$request->input('environment'), $request->input('name'));
            endif;
            $e->name =  e($request->input('name'));
            $e->brand =  e($request->input('brand'));
            $e->model =  e($request->input('model'));
            $e->serie =  e($request->input('serie'));
            $e->no_bien =  e($request->input('no_bien'));
            $e->critical_level =  e($request->input('critical_level'));
            $e->type =  e($request->input('type'));
            $e->capacity =  e($request->input('capacity'));
            $e->num_station =  e($request->input('num_station'));
            $e->year_warranty =  $request->input('year_warranty');
            $e->date_instalaction =  $request->input('date_instalaction');
            $e->frequency =  $request->input('frequency');
            $e->features =  e($request->input('features'));
            $e->description =  e($request->input('description'));
            $e->idservicegeneral = $request->input('servicegeneral');
            $e->idservice = $request->input('service');
            $e->idenvironment = $request->input('environment');
            $e->trained_staff =  e($request->input('trained_staff'));
            $e->status =  "0";

            if($e->save()):
                $b = new Bitacora;
                $b->action = "Registro de equipo ".$e->code_new;
                $b->user_id = Auth::id();
                $b->save();

                return redirect('/admin/equipments/all')->with('messages', '¡Equipo registrado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function GenerateCode( $r_area, $r_ambiente, $r_equipon, $id_area_usuario = null){
        /* Proceso para obtener el codigo del equipo */
        $area = MaintenanceArea::findOrFail($r_area);
        $ambiente = Environment::findOrFail($r_ambiente);
        if(Auth::user()->role == "0"):
            $area_usuario = MaintenanceArea::findOrFail($id_area_usuario);
        else:
            $area_usuario = MaintenanceArea::findOrFail(Auth::user()->idmaintenancearea);
        endif;

        $equipo =  $r_equipon;
            /* Se cuentan si hay equipos con los mismos datos para sacar un correlativo */
        /*$eq_anteriores = Equipment::where('name', $r_equipon)
                                    ->where('idmaintenancearea', $area->id)
                                    ->where('idenvironment', $ambiente->id)
                                    ->count();*/

                                    /*Se quito el id del ambiente para que el conteo sea en general
                                      sin tomar en cuenta este mismo  */
        $eq_anteriores = Equipment::where('name', $r_equipon)
                                    ->where('idmaintenancearea', $area->id)
                                    ->count();

        if($eq_anteriores != '0'):
            $correlativo = $eq_anteriores + 1; //Si hay equipos registrados con la misma informacion.
        else:
            $correlativo = 1; //Si no hay equipos registrados con la misma informacion, se inicia el correlativo.
        endif;
            /* Se extraen las iniciales del nombre del equipo */
        $equipo = explode(" ", $r_equipon);
        $iniciales = "";
        foreach ($equipo as $w) {
            $iniciales .= $w[0];
        }
        $code = $area_usuario->unit->code.'-'.$area->id.'-'.$ambiente->code.'-'.$iniciales.$correlativo;
        return $code;
    }

    public function getEquipmentEdit($id){
        $equipment = Equipment::findOrFail($id);
        $servicegeneral = Environment::where('parent', '0')->where('status', '0')->pluck('name', 'id');
        $suppliers = Supplier::get();

        $fecha_actual = Carbon::now()->format('Y-m-d'); //fecha actual
        $tiempo_garantia = $equipment->year_warranty; //mese de garantia del equipo
        $instalacion = $equipment->date_instalaction; // fecha de instalacion del equipo
        $garantia_hasta = Carbon::parse($instalacion)->addMonths($tiempo_garantia)->format('Y-m-d'); // suma del tiempo de meses de garantia y la fecha de instalacion
        $tiempo_restante = Carbon::parse($garantia_hasta)->diffInMonths(Carbon::now()); //Tiempo restante de garantia en meses - diferencia entre la fecha total de la garantia y fecha actual

        if(Auth::user()->idmaintenancearea != 0 ):
            $maintenance_areas = MaintenanceArea::where('id', Auth::user()->idmaintenancearea)->get();
        else:
            $maintenance_areas = MaintenanceArea::get();
        endif;

        $data = [
            'equipment' => $equipment,
            'maintenance_areas' => $maintenance_areas,
            'servicegeneral' => $servicegeneral,
            'suppliers' => $suppliers,
            'tiempo_restante' => $tiempo_restante
        ];

        return view('admin.equipments.edit',$data);
    }

    public function postEquipmentEdit(Request $request, $id){
        $rules = [

        ];

        $messages = [

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $e = Equipment::findOrFail($id);
            $e->code_old = $request->input('code_old');
            $e->idsupplier =  $request->input('idsupplier');
            $e->brand =  e($request->input('brand'));
            $e->model =  e($request->input('model'));
            $e->serie =  e($request->input('serie'));
            $e->no_bien =  e($request->input('no_bien'));
            $e->critical_level =  e($request->input('critical_level'));
            $e->type =  e($request->input('type'));
            $e->capacity =  e($request->input('capacity'));
            $e->num_station =  e($request->input('num_station'));
            $e->year_warranty =  $request->input('year_warranty');
            $e->date_instalaction =  $request->input('date_instalaction');
            $e->frequency =  $request->input('frequency');
            $e->features =  e($request->input('features'));
            $e->description =  e($request->input('description'));
            $e->trained_staff =  e($request->input('trained_staff'));
            $e->person_in_charge =  e($request->input('person_in_charge'));

            if($e->save()):
                $b = new Bitacora;
                $b->action = "Actualización de equipo ".$e->code_new;
                $b->user_id = Auth::id();
                $b->save();
                return back()->with('messages', '¡Equipo actualizado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getEquipmentFiles($id){
        $equipment = Equipment::findOrFail($id);
        $files = EquipmentFG::where('idequipment', $id)->where('type_file', '0')->get();
        $gallery = EquipmentFG::where('idequipment', $id)->where('type_file', '1')->get();

        $data = [
            'equipment' => $equipment,
            'files' => $files,
            'gallery' => $gallery
        ];

        return view('admin.equipments.files',$data);
    }

    public function postEquipmentUploadFile(Request $request, $id){
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

                $ef = new EquipmentFG;
                $ef->idequipment = $id;
                $ef->file_path = date('Y-m-d');
                $ef->file_name = $filename;
                $ef->description = e($request->input('description'));
                $ef->type_manual = $request->input('type_manual');
                $ef->type_file = "0";

                if($ef->save()):
                    if($request->hasFile('file_name')):
                        $fl = $request->file('file_name')->storeAs($path, $filename, 'uploads_files');
                    endif;
                    $b = new Bitacora;
                    $b->action = "Carga de manual ".$ef->file_name." del equipo".$ef->equipment->no_bien;
                    $b->user_id = Auth::id();
                    $b->save();

                    return back()->with('messages', 'Manual subido con exito!.')
                        ->with('typealert', 'success');
                endif;

            endif;
        endif;
    }

    public function postEquipmentUploadImage(Request $request, $id){
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

                $ef = new EquipmentFG;
                $ef->idequipment = $id;
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
                    $b->action = "Carga de foto ".$ef->file_name." del equipo".$ef->equipment->no_bien;
                    $b->user_id = Auth::id();
                    $b->save();

                    return back()->with('messages', 'Foto subida con exito!.')
                        ->with('typealert', 'success');
                endif;

            endif;
        endif;
    }

    public function getEquipmentDataSheet($id){
        $equipment = Equipment::findOrFail($id);
        $parts = EquipmentPart::where('idequipment', $id)->get();
        $conecctions = EquipmentConecction::where('idequipment', $id)->get();
        $fecha = date('d/m/Y');
        $gallery = EquipmentFG::where('idequipment', $id)->where('type_file', '1')->get();
        $files = EquipmentFG::where('idequipment', $id)->where('type_file', '0')->get();
        $transfers = EquipmentTransfer::where('idequipment', $id)->get();

        $data = [
            'equipment' => $equipment,
            'parts' => $parts,
            'conecctions' => $conecctions,
            'fecha'=>$fecha,
            'gallery' => $gallery,
            'files' => $files,
            'transfers' => $transfers
        ];

        $pdf = PDF::loadView('admin.equipments.data_sheet',$data);
        return $pdf->stream('Ficha Tecnica.pdf');
    }

    public function getEquipmentParts($id){
        $equipment = Equipment::findOrFail($id);
        $parts = EquipmentPart::where('idequipment', $id)->get();

        $data = [
            'equipment' => $equipment,
            'parts' => $parts
        ];

        return view('admin.equipments.parts',$data);
    }

    public function postEquipmentParts(Request $request, $id){
        $rules = [

        ];

        $messages = [

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', '¡Se ha producido un error!.')
            ->withInput();
        else:

            $ep = new EquipmentPart;
            $ep->id =  $request->input('id');
            $ep->idequipment =  $id;
            $ep->name_part =  $request->input('name_part');
            $ep->amount_part =  e($request->input('amount_part'));
            $ep->observation_part =  e($request->input('observation_part'));

            if($ep->save()):
                $b = new Bitacora;
                $b->action = "Registro de parte: ".$ep->name_part." al equipo: ".$ep->equipment->name;
                $b->user_id = Auth::id();
                $b->save();
                return back()->with('messages', '¡Parte del equipo cargada con exito!.')
                        ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getEquipmentPartsDelete($id){
        $p = EquipmentPart::findOrFail($id);

        if($p->delete()):
            return back()->with('messages', '¡Parte del equipo eliminada con exito!.')
                    ->with('typealert', 'success');
        endif;
    }

    public function getEquipmentConecctions($id){
        $equipment = Equipment::findOrFail($id);
        if(Auth::user()->role == "0"):
            $equipments = Equipment::where('id', '!=', $id)->get();
        else:
            $equipments = Equipment::where('id', '!=', $id)->where('idmaintenancearea', Auth::user()->idmaintenancearea)->get();
        endif;
        $conecctions = EquipmentConecction::where('idequipment', $id)->get();

        $data = [
            'equipment' => $equipment,
            'equipments' => $equipments,
            'conecctions' => $conecctions
        ];

        return view('admin.equipments.conecctions',$data);
    }

    public function postEquipmentConecctions(Request $request, $id){
        $rules = [

        ];

        $messages = [

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', '¡Se ha producido un error!.')
            ->withInput();
        else:

            $ec = new EquipmentConecction;
            $ec->idequipment =  $id;
            $ec->idequipment_conecction =  $request->input('idequipmentconecction');
            $ec->observation =  e($request->input('observation'));

            if($ec->save()):
                $b = new Bitacora;
                $b->action = "Registro de conexion: ".$ec->idequipment_conecction." al equipo: ".$id;
                $b->user_id = Auth::id();
                $b->save();
                return back()->with('messages', 'Conexio del equipo registrada con exito!.')
                        ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getEquipmentConecctionsDelete($id){
        $ec = EquipmentConecction::findOrFail($id);

        if($ec->delete()):
            return back()->with('messages', '¡Conexión del equipo eliminada con exito!.')
                    ->with('typealert', 'success');
        endif;
    }

    public function getEquipmentTransfer($id){
        $servicegeneral = Environment::where('parent', '0')->where('status', '0')->pluck('name', 'id');
        $equipment = Equipment::findOrFail($id);
        $transfers = EquipmentTransfer::where('idequipment', $id)->get();

        $data = [
            'equipment' => $equipment,
            'transfers' => $transfers,
            'servicegeneral' => $servicegeneral
        ];

        return view('admin.equipments.transfer',$data);
    }

    public function postEquipmentTransfer(Request $request, $id){
        $rules = [

        ];

        $messages = [

        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', '¡Se ha producido un error!.')
            ->withInput();
        else:

            $et = new EquipmentTransfer;
            $et->date =  $request->input('date');
            $et->idequipment =  $id;
            $et->idservicegeneral = $request->input('servicegeneral');
            $et->idservice = $request->input('service');
            $et->idenvironment = $request->input('environment');
            $et->reason =  e($request->input('reason'));

            if($et->save()):
                $b = new Bitacora;
                $b->action = "Registro de cambio de ambiente del equipo ID: ".$id;
                $b->user_id = Auth::id();
                $b->save();
                return back()->with('messages', '¡Traslado del equipo registrado con exito!.')
                        ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getEquipmentPrintLabel($id){
        $equipment = Equipment::findOrFail($id);

        $data = [
            'equipment' => $equipment
        ];

        $pdf = PDF::loadView('admin.equipments.print_label',$data)->setPaper(array(0, 0, 175.75, 249.45), 'portrait');
        return $pdf->stream('Etiqueta de Equipo.pdf');
    }

    public function getEquipmentPanel($id){
        $equipment = Equipment::findOrFail($id);
        $parts = EquipmentPart::where('idequipment', $id)->get();
        $conecctions = EquipmentConecction::where('idequipment', $id)->get();
        $transfers = EquipmentTransfer::where('idequipment', $id)->get();

        $data = [
            'equipment' => $equipment,
            'parts' => $parts,
            'conecctions' => $conecctions,
            'transfers' => $transfers
        ];

        return view('admin.equipments.panel',$data);
    }

    public function getEquipmentChangeStatus($id, $status){
        $e = Equipment::findOrFail($id);
        $e->status = $status;

        if($e->save()):
            $b = new Bitacora;
            $b->action = "Cambio de estado de equipo ".$e->code_new;
            $b->user_id = Auth::id();
            $b->save();

            return redirect('/admin/equipments/all')->with('messages', '¡Estado actualizado y guardado con exito!.')
                ->with('typealert', 'success');
        endif;

    }


}
