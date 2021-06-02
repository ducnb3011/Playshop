<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ProductController extends Controller
{
    public function addProduct() {
        $all_brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        return view('admin.add_product')->with('category_product', $all_category_product)->with('brand_product', $all_brand_product);
    }
    public function allBrandProduct() {
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all-brand-product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all-brand-product', $manager_brand_product);
        
    }
    public function saveProduct(Request $request) {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['brand_id'] = $request->product_brand;
        $data['category_id'] = $request->product_category;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $image_name = current(explode('.', $get_name_image));
            $new_image = $image_name.rand(0,199).rand(0,199).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', "Thêm sản phẩm thành công");
            return Redirect::to('/add-product');
        }
        $data['product_image'] = "";
        DB::table('tbl_product')->insert($data);
        Session::put('message', "Thêm sản phẩm thành công");
        return Redirect::to('/add-product');
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
