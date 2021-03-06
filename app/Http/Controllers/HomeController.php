<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class HomeController extends Controller
{
    public function index() {
        $all_brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status', '1')->orderby('product_id','desc')->limit(6)->get(); 
        $all_banner = DB::table('tbl_banner')->orderby('banner_id','asc')->get();

        return view('pages.home')->with('category_product', $all_category_product)->with('brand_product', $all_brand_product)
        ->with('all_product', $all_product)->with('all_banner', $all_banner);
    }
}
