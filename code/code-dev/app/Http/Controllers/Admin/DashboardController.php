<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Models\Product, App\Http\Models\Environment, App\Http\Models\IncomeDetailProduct;
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
        $products = Product::where('type','!=','3')->count();
        $services = Environment::where('type','=','1')->count();
        $environments = Environment::where('type','=','2')->count();

        $record = DB::table('incomes_details_products')
        ->join('products','incomes_details_products.idproduct','=','products.id')
        ->select(\DB::raw("SUM(incomes_details_products.amount) as ingresos"), 'products.name', 'products.code_ppr')
        ->groupBy('incomes_details_products.idproduct')
        ->orderByRaw('SUM(incomes_details_products.amount) desc')
        ->limit(5)
        ->get();

        $etiquetas = [];

        foreach($record as $row) {
            $etiquetas['label'][] =  $row->code_ppr;
            $etiquetas['data'][] = (int) $row->ingresos;
        }


        $data = [
            'users' => $users,
            'chart_data' => json_encode($etiquetas),
            'products' => $products,
            'services' => $services,
            'environments' => $environments

        ];

        return view('admin.dashboard',$data);
    }

    
}
