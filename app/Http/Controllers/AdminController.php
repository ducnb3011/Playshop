<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class AdminController extends Controller
{
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('/dashboard');
        }
        else {
            return Redirect::to('/admin')->send();
        }
    }
    public function index() {
        $admin_id=Session::get('admin_id');
        if($admin_id){
    	    return Redirect::to('dashboard');
        }else{
            return view('admin_login');
        }
        //return view('admin_login');
    }
    public function show_dashboard() {
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request) {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result!=null) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        }
        else {
            Session::put('message', "Tài khoản hoặc mật khẩu sai");
            return Redirect::to('/admin');
        }
    }
    public function logout() {
        $this->AuthLogin();
        Session::put('admin_id', null);
        Session::put('admin_name', null);
        return Redirect::to('/admin');
    }
}
