<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = Customer::all();

        return view('dashboard', ['user' => $user]);
    }

    public function save(Request $req){
        $validated = $req->validate([
            'phone' => 'required|unique:customers|max:255',
            'fname' => 'required',
            'lname' => 'required',
        ]);
        $user = new Customer();

        $user->fname = $req->fname;
        $user->lname = $req->lname;
        $user->phone = $req->phone;

        if( $validated){
            $user->save();
            $req->session()->flash('success', 'Record saved');
            return back();
        }else{
            $req->session()->flash('failed', 'Error');
            return back();
        }
    }

    public function get_user(Request $req){
        $user = Customer::find($req->id);

        return response()->json($user);
    }

    public function update_user(Request $req){
        $user = Customer::find($req->id);

        $user->fname = $req->fname;
        $user->lname = $req->lname;
        $user->phone = $req->phone;


        if( $user->update()){
            $req->session()->flash('success', 'Record saved');
            return back();
        }else{
            $req->session()->flash('failed', 'Error');
            return back();
        }
    }

    public function del_user(Request $req){
        $user = Customer::find($req->id);

        if( $user->delete()){
            $req->session()->flash('success', 'Record deleted');
            return back();
        }else{
            $req->session()->flash('failed', 'Error');
            return back();
        }
    }

    public function black_white(Request $req){
        $user = Customer::find($req->id);

        if($user->status == 1){
            
            $user->status = '0';
            $user->update();
            dd($user->update());
        }elseif($user->status == 0){
            $user->status = '1';
            $user->update();

            $req->session()->flash('success', 'Record updated');
            return back();
        }

    }
}
