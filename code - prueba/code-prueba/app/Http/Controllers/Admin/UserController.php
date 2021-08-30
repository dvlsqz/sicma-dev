<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User, App\Http\Models\Unit, App\Http\Models\Service, App\Http\Models\Bitacora, App\Http\Models\MaintenanceArea;
use Validator, Auth, Hash, Config;

class UserController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getUsers($status){
        switch ($status) {
            case '0':
                $users = User::where('status', '0')->orderBy('id', 'Asc')->get();
            break;

            case '1':
                $users = User::where('status', '1')->orderBy('id', 'Asc')->get();
            break;

            case 'all':
                $users = User::orderby('id','Asc')->get();
            break;

            case 'trash':
                $users = User::onlyTrashed()->orderBy('id', 'Asc')->get();
            break;
        }

        $data = [
            'users'=>$users,
        ];

        return view('admin.users.home',$data);
    }

    public function getUserAdd(){
        return view('admin.users.add');
    }

    public function postUserAdd(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'ibm' => 'required|unique:users,ibm'
        ];

        $messages = [
            'name.required' => 'El nombre es requerido.',
            'lastname.required' => 'El apellido es requerido.',
            'ibm.required' => 'El numero de IBM es requerido.',
            'ibm.unique' => 'Ya existe un usuario registrado con este numero de IBM'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', '¡Se ha producido un error!.')->withInput();
        else:
            $password = Config::get('sidex.default_password');

            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->ibm = e($request->input('ibm'));
            $user->password = Hash::make($password);
            $permissions = [
                'dashboard' => true
            ];

            $permissions = json_encode($permissions);
            $user->permissions = $permissions;
            $user->role = '2';
            $user->status = '1';

            if($user->save()):
                $b = new Bitacora;
                $b->action = "Creación de usuario con IBM: ".$user->ibm;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('success', '¡El usuario se creo con éxito, ahora puede iniciar sesión!');
            endif;
        endif;
    }

    public function getUserEdit($id){

        $u = User::findOrFail($id);
        $maintenance_areas = MaintenanceArea::pluck('name','id');

        $data = [
            'u' => $u,
            'maintenance_areas' => $maintenance_areas
        ];

        return view('admin.users.user_edit',$data);
    }

    public function postUserEdit($id, Request $request){
        $u = User::findOrFail($id);
        $ibm = $u->ibm;

        if($request->input('name') ):
            $u->name = e($request->input('name'));
        endif;

        if($request->input('lastname') ):
            $u->lastname = e($request->input('lastname'));
        endif;

        if($request->input('ibm') ):
            $u->ibm = e($request->input('ibm'));
        endif;

        if($request->input('idarea') ):
            $u->idmaintenancearea = e($request->input('idarea'));
        endif;

        $rol_actual = $u->role;

        if($request->input('user_type') != $rol_actual ):
            $u->role = $request->input('user_type');

            if($request->input('user_type') == "1" ):
                if(!is_null($u->permissions) || !is_null($u->permissions) ):
                    $permissions = [
                        'home' => true,
                        'dashboard' => true,
                        'units'=>true,
                        'unit_edit'=>true,
                        'services'=>true,
                        'service_add'=>true,
                        'service_edit'=>true,
                        'service_delete'=>true,
                        'service_search'=>true,
                        'telephone_extensions'=>true,
                        'telephone_extension_add'=>true,
                        'telephone_extension_edit'=>true,
                        "telephone_extension_location_edit"=>true,
                        "telephone_extension_status_edit"=>true,
                        'telephone_extension_delete'=>true,
                        'telephone_extension_search'=>true,
                        'report_user'=>true,
                        "report_informatica"=>true,
                        'report_bitacora'=>true,
                        'user_list'=>true,
                        'user_add'=>true,
                        'user_edit'=>true,
                        'user_banned'=>true,
                        'user_delete'=>true,
                        'user_reset_password'=>true,
                        'user_permissions'=>true,
                        'user_assignments'=>true,
                        'user_assignments_units'=>true,
                        'user_assignments_services'=>true,
                        'user_assignments_delete'=>true
                    ];

                    $permissions = json_encode($permissions);
                    $u->permissions = $permissions;
                endif;
            elseif($request->input('user_type') == "2"):
                if(is_null($u->permissions) || !is_null($u->permissions) ):
                    $permissions = [
                        'home' => true,
                        'dashboard' => true,
                        'services'=>true,
                        'telephone_extensions'=>true,
                        'telephone_extension_edit'=>true,
                        'telephone_extension_search'=>true,
                        'report_user'=>true
                    ];

                    $permissions = json_encode($permissions);
                    $u->permissions = $permissions;
                endif;
            endif;
        endif;

        if($u->save()):
            $b = new Bitacora;
            $b->action = "Actualización de datos de usuario con IBM: ".$ibm;
            $b->user_id = Auth::id();
            $b->save();

            /*return back()->with('messages', 'La información del usuario, se actualizo con éxito!.')
                ->with('typealert', 'success');*/
            return back()->with('success','La información del usuario, se actualizo con éxito!.');

        endif;
    }

    public function getUserBanned($id){
        $u = User::findOrFail($id);

        if($u->status == "0"):
            $u->status = "1";
            $msg = "¡Usuario activado nuevamente!.";

            $b = new Bitacora;
            $b->action = "Activación de usuario con IBM: ".$u->ibm;
            $b->user_id = Auth::id();
            $b->save();
        else:
            $u->status = "0";
            $msg = "¡Usuario suspendido con exito!.";

            $b = new Bitacora;
            $b->action = "Suspensión de usuario con IBM: ".$u->ibm;
            $b->user_id = Auth::id();
            $b->save();
        endif;

        if($u->save()):
            return back()->with('success', $msg);
        endif;
    }

    public function getUserPermissions($id){
        $u = User::findOrFail($id);
        $data = ['u' => $u];

        return view('admin.users.user_permissions', $data);
    }

    public function postUserPermissions(Request $request, $id){
        $u = User::findOrFail($id);
        $u->permissions = $request->except(['_token']);

        if($u->save()):
            $b = new Bitacora;
            $b->action = "Actualización de permisos de usuario con IBM: ".$u->ibm;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('success', '¡Los permisos del usuario fueron actualizados con éxito!.');
        endif;
    }

    public function postResetPassword($id, Request $request){
        $rules = [
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'

        ];

        $messages = [
            'password.required' => 'Escriba su nueva contraseña .',
            'password.min' => 'Su nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.required' => 'Confirme su nueva contraseña .',
            'cpassword.min' => 'SLa confirmación de la nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.same' => 'Las contraseñas no coinciden'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', '¡Se ha producido un error!.')
            ->withInput();
        else:
            $u = User::findOrFail($id);
            $u->password = Hash::make($request->input('password'));

            if($u->save()):
                $b = new Bitacora;
                $b->action = "Restablecimiento de contraseña de usuario con IBM: ".$u->ibm;
                $b->user_id = Auth::id();
                $b->save();
                return back()->with('success', '¡La contraseña se restablecio con exito!.');
            endif;

        endif;
    }

    public function getAccountInfo(){
        $data = [
        ];

        return view('admin.users.account',$data);
    }

    public function postAccountChangePassword(Request $request){
        $rules = [
            'apassword' => 'required|min:8',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'

        ];

        $messages = [
            'apassword.required' => 'Escriba su contraseña actual.',
            'apassword.min' => 'La contraseña actual debe de tener al menos 8 caracteres',
            'password.required' => 'Escriba su nueva contraseña .',
            'password.min' => 'Su nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.required' => 'Confirme su nueva contraseña .',
            'cpassword.min' => 'La confirmación de la nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.same' => 'Las contraseñas no coinciden'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('error', 'Se ha producido un error.')
            ->withInput();
        else:
            $u = User::find(Auth::id());

            if(Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password'));

                if($u->save()):
                    $b = new Bitacora;
                    $b->action = "Usuario con IBM: ".$u->ibm." cambio su contraseña";
                    $b->user_id = Auth::id();
                    $b->save();

                    return back()->with('success', 'La contraseña se actualizo con exito!.');
                endif;
            else:
                return back()->with('error', 'Su contraseña actual es errónea, verifiquela por favor.');
            endif;
        endif;
    }

}
