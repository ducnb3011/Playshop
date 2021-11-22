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
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('/dashboard');
        }
        else {
            return Redirect::to('/admin')->send();
        }
    }
    public function addBrandProduct() {
        $this->AuthLogin();
        return view('admin.add-brand-product');
    }
    public function allBrandProduct() {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all-brand-product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all-brand-product', $manager_brand_product);
        
    }
    public function saveBrandProduct(Request $request) {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand')->insert($data);
        Session::put('message', "Thêm danh mục thành công");
        return Redirect::to('/add-brand-product');
    }
    public function activeBrandProduct( $brand_product_id ) {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',  $brand_product_id)->update(['brand_status'=>1]);
        Session::put('message', "Brand online");
        return Redirect::to('/all-brand-product');
    }
    public function unactiveBrandProduct( $brand_product_id ) {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',  $brand_product_id)->update(['brand_status'=>0]);
        Session::put('message', "Brand offline");
        return Redirect::to('/all-brand-product');
    }
    public function editBrandProduct( $brand_product_id ) {
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->first();
        $manager_brand_product = view('admin.edit-brand-product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit-brand-product', $manager_brand_product);
    }
    public function updateBrandProduct( Request $request, $brand_product_id ) {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
        Session::put('message', "Brand $request->brand_product_name update");
        return Redirect::to('/all-brand-product');
    }
    public function deleteBrandProduct( $brand_product_id ) {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        return Redirect::to('/all-brand-product');
    }


    // Client function
    public function showBrandHome($brand_product_id) {
        $all_brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','desc')->get();
        $brand_selected = DB::table('tbl_brand')->where('brand_id', $brand_product_id)
        ->where('brand_status', '1')->orderby('brand_id','desc')->first();
        $all_banner = DB::table('tbl_banner')->orderby('banner_id','asc')->get();
        $all_product = DB::table('tbl_product')->orderby('product_id', 'desc')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.product_status', '1')
        ->where('tbl_brand.brand_id', $brand_product_id)
        ->where('tbl_brand.brand_status', '1')->get();

        return view('pages.brand.show_brand')->with('category_product', $all_category_product)->with('brand_product', $all_brand_product)
        ->with('all_banner', $all_banner)->with('all_product', $all_product)->with('brand_selected', $brand_selected);
    }
}
