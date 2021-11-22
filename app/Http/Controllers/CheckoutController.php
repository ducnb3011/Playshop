<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Session;
session_start();

class CheckoutController extends Controller
{
    public function loginCheckout() {
        $all_brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','desc')->get();
        $all_banner = DB::table('tbl_banner')->orderby('banner_id','asc')->get();
        return view('pages.checkout.login_checkout')->with('category_product', $all_category_product)->with('brand_product', $all_brand_product)
        ->with('all_banner', $all_banner);
    }
}
