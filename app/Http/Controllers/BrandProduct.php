<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class BrandProduct extends Controller
{
    public function addBrandProduct() {
        return view('admin.add-brand-product');
    }
    public function allBrandProduct() {
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all-brand-product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all-brand-product', $manager_brand_product);
        
    }
    public function saveBrandProduct(Request $request) {
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand')->insert($data);
        Session::put('message', "Thêm danh mục thành công");
        return Redirect::to('/add-brand-product');
    }
    public function activeBrandProduct( $brand_product_id ) {
        DB::table('tbl_brand')->where('brand_id',  $brand_product_id)->update(['brand_status'=>1]);
        Session::put('message', "Brand online");
        return Redirect::to('/all-brand-product');
    }
    public function unactiveBrandProduct( $brand_product_id ) {
        DB::table('tbl_brand')->where('brand_id',  $brand_product_id)->update(['brand_status'=>0]);
        Session::put('message', "Brand offline");
        return Redirect::to('/all-brand-product');
    }
    public function editBrandProduct( $brand_product_id ) {
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->first();
        $manager_brand_product = view('admin.edit-brand-product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit-brand-product', $manager_brand_product);
    }
    public function updateBrandProduct( Request $request, $brand_product_id ) {
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
        Session::put('message', "Brand $request->brand_product_name update");
        return Redirect::to('/all-brand-product');
    }
    public function deleteBrandProduct( $brand_product_id ) {
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        return Redirect::to('/all-brand-product');
    }
}
