<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Environment, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth, Session, DB, Response;

class EnvironmentController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome($status){
        switch ($status) {
            case '0':
                $environment = Environment::where('parent', '0')->where('status', '0')->orderBy('id', 'Asc')->paginate(25);
            break;

            case '1':
                $environment = Environment::where('parent', '0')->where('status', '1')->orderBy('id', 'Asc')->paginate(25);
            break;

            case 'all':
                $environment = Environment::where('parent', '0')->orderby('id','Asc')->get();
            break;

            case 'trash':
                $environment = Environment::onlyTrashed()->orderBy('id', 'Asc')->paginate(25);
            break;
        }

        $data = [
            'environment' => $environment
        ];

        return view('admin.environments.home',$data);
    }

    public function postServicesGeneralAdd(Request $request){
        $rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el servicio general.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $sg = new Environment;
            $sg->name = e($request->input('name'));
            $sg->parent = '0';
            $sg->description = e($request->input('description'));

            if($sg->save()):
                $b = new Bitacora;
                $b->action = "Registro de servicio general ".$sg->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', 'Creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getServicesGeneralServices($id){
        $environment = Environment::findOrFail($id);
        $services = Environment::where('parent', $id)->get();
        $id = $id;

        $data = [
            'environment' => $environment,
            'services' => $services,
            'id' => $id
        ];

        return view('admin.environments.services', $data);
    }

    public function postServicesGeneralServicesAdd(Request $request){
        $rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el servicio general.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $s = new Environment;
            $s->level = e($request->input('level'));
            $s->name = e($request->input('name'));
            $s->parent = $request->input('parent');
            $s->description = e($request->input('description'));
            $s->reference = e($request->input('reference'));

            if($s->save()):
                $b = new Bitacora;
                $b->action = "Registro de servicio ".$s->name." del servicio general";
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', 'Creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getServicesEnvironments($id){
        $service = Environment::findOrFail($id);
        $environments = Environment::where('parent', $id)->get();
        $id = $id;

        $data = [
            'service' => $service,
            'environments' => $environments,
            'id' => $id
        ];

        return view('admin.environments.environment', $data);
    }

    public function postServicesEnvironmentsAdd(Request $request){
        $rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el servicio general.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $env = new Environment;
            $env->code = e($request->input('code'));
            $env->name = e($request->input('name'));
            $env->parent = $request->input('parent');
            $env->measures = $request->input('measures');
            $env->description = e($request->input('description'));
            $env->reference = e($request->input('reference'));

            if($env->save()):
                $b = new Bitacora;
                $b->action = "Registro de ambiente: ".$env->name." del servicio: ";
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', 'Creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }
}
