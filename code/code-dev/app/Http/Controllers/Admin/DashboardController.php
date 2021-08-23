<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Models\Product;
use DB;
use Carbon\Carbon;


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

        $record = Product::select(\DB::raw("COUNT(*) as count"), 'type','name','code_ppr')
        ->where('stock','>','0')
        ->groupBy('type')
        ->orderBy('type','asc')
        ->get();

        $etiquetas = [];

        foreach($record as $row) {
            $etiquetas['label'][] =  $row->code_ppr.' '.$row->name;
            $etiquetas['data'][] = (int) $row->count;
        }

        $data = [
            'users' => $users,
            'chart_data' => json_encode($etiquetas)

        ];
        return view('admin.dashboard',$data);
    }

    
}
