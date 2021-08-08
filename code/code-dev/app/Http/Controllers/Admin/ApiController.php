<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Environment;

class ApiController extends Controller
{
    public function __Construct(){
    	$this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function getService($parent){
        $services = Environment::where('type', '1')->where('parent', $parent)->get();

        return response()->json($services);
    }

    public function getEnvironment($parent){
        $environment = Environment::where('type', '2')->where('parent', $parent)->get();

        return response()->json($environment);
    }
}
