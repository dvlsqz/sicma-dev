<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Store;

class StoreController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getStore($status){
        switch ($status) {
            case '0':
                $store = Store::where('type', '0')->orderBy('id', 'Asc')->paginate(25);
            break;

            case '1':
                $store = Store::where('type', '1')->orderBy('id', 'Asc')->paginate(25);
            break;

            case '2':
                $store = Store::where('type', '2')->orderBy('id', 'Asc')->paginate(25);
            break;

            case '3':
                $store = Store::where('type', '3')->orderBy('id', 'Asc')->paginate(25);
            break;

            case 'all':
                $store = Store::orderby('id','Asc')->paginate(30);
            break;

            case 'trash':
                $store = Store::onlyTrashed()->orderBy('id', 'Asc')->paginate(25);
            break;
        }

        $data = [
            'store'=>$store,
        ];

        return view('admin.store.home',$data);
    }

    public static function response($stock,$price_unit)
    {
        $res = $stock * $price_unit;
        return $res;
    }

    public function getStoreEdit($id){

        $store = Store::findOrFail($id);
        $data = ['store' => $store];

        return view('admin.store.store_edit',$data);
    }

    public function getStoreAdd(){
        return view('admin.store.store_add');

    }
}
