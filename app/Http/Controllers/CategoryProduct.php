<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CategoryProduct extends Controller
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
    public function addCategoryProduct() {
        $this->AuthLogin();
        return view('admin.add-category-product');
    }
    public function allCategoryProduct() {
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all-category-product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all-category-product', $manager_category_product);
        
    }
    public function saveCategoryProduct(Request $request) {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data);
        Session::put('message', "Thêm danh mục thành công");
        return Redirect::to('/add-category-product');

    }
    public function activeCategoryProduct( $category_product_id ) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',  $category_product_id)->update(['category_status'=>1]);
        Session::put('message', "Category online");
        return Redirect::to('/all-category-product');
    }
    public function unactiveCategoryProduct( $category_product_id ) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',  $category_product_id)->update(['category_status'=>0]);
        Session::put('message', "Category offline");
        return Redirect::to('/all-category-product');
    }
    public function editCategoryProduct( $category_product_id ) {
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->first();
        $manager_category_product = view('admin.edit-category-product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit-category-product', $manager_category_product);
    }
    public function updateCategoryProduct( Request $request, $category_product_id ) {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message', "Category $request->category_product_name update");
        return Redirect::to('/all-category-product');
    }
    public function deleteCategoryProduct( $category_product_id ) {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        return Redirect::to('/all-category-product');
    }

    // Client function
    public function showCategoryHome($category_product_id) {
        $all_brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','desc')->get();
        $category_selected = DB::table('tbl_category_product')->where('category_id', $category_product_id)
        ->where('category_status', '1')->orderby('category_id','desc')->first();
        $all_banner = DB::table('tbl_banner')->orderby('banner_id','asc')->get();
        $all_product = DB::table('tbl_product')->orderby('product_id', 'desc')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->where('tbl_product.product_status', '1')
        ->where('tbl_category_product.category_id', $category_product_id)
        ->where('tbl_category_product.category_status', '1')->get();

        return view('pages.category.show_category')->with('category_product', $all_category_product)->with('brand_product', $all_brand_product)
        ->with('all_banner', $all_banner)->with('all_product', $all_product)->with('category_selected', $category_selected);
    }
}
