<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;


class DashboardController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('Permissions');
        $this->middleware('UserStatus');
        
    }

    public function getDashboard(){
        $users = User::count();

        $data = [
            'users' => $users

        ];
        return view('admin.dashboard',$data);
    }
}
