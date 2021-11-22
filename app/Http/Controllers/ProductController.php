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
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('/dashboard');
        }
        else {
            return Redirect::to('/admin')->send();
        }
    }
    public function addProduct() {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        return view('admin.add_product')->with('category_product', $all_category_product)->with('brand_product', $all_brand_product);
    }
    public function allProduct() {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')->orderby('product_id', 'desc')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
        
    }
    public function saveProduct(Request $request) {
        $this->AuthLogin();
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
    public function activeProduct( $product_id ) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',  $product_id)->update(['product_status'=>1]);
        Session::put('message', "Product online");
        return Redirect::to('/all-product');
    }
    public function unactiveProduct( $product_id ) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',  $product_id)->update(['product_status'=>0]);
        Session::put('message', "Product offline");
        return Redirect::to('/all-product');
    }
    public function editProduct( $product_id ) {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->first();
        $manager_brand_product = view('admin.edit_product')->with('edit_product', $edit_product)
        ->with('category_product', $all_category_product)->with('brand_product', $all_brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_brand_product);
    }
    public function updateProduct( Request $request, $product_id ) {
        $this->AuthLogin();
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
            if($new_image != "") {
                $get_image->move('public/uploads/product', $new_image);
                $data['product_image'] = $new_image;
            }
            else {
                $data['product_image'] = $request->product_old_image;
            }
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', "Product $request->product_name update");
            return Redirect::to('/all-product');
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', "Product $request->product_name update");
        return Redirect::to('/all-product');
    }
    public function deleteBrandProduct( $brand_product_id ) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        return Redirect::to('/all-product');
    }
    public function detailProduct ($product_id) {
        $all_brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','desc')->get();
        $all_banner = DB::table('tbl_banner')->orderby('banner_id','asc')->get();
        $detail_product = DB::table('tbl_product')->orderby('product_id', 'desc')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_id', $product_id)->first();

        $relate_product = DB::table('tbl_product')->orderby('product_price', 'desc')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.category_id', $detail_product->category_id)->whereNotIn('product_id', [$detail_product->product_id])
        ->limit(4)->get();
        
        return view('pages.product.product_detail')->with('category_product', $all_category_product)->with('brand_product', $all_brand_product)
        ->with('all_banner', $all_banner)->with('detail_product', $detail_product)->with('relate_product', $relate_product);
    }
}
