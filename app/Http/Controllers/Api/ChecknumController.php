<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ChecknumController extends Controller
{
    public function index(Request $req){
       $check = Customer::where('phone', '=', $req->phone)->where('status', '=', '1')->first();
        
       if($check){
            return response()->json(['msg' => 'active', 'status' => 1, 'number' => $check->phone]);
       }else{
        return response()->json(['msg' => 'blocked', 'status' => 1]);
       }

      
    }
}
