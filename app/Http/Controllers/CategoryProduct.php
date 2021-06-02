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
    public function addCategoryProduct() {
        return view('admin.add-category-product');
    }
    public function allCategoryProduct() {
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all-category-product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all-category-product', $manager_category_product);
        
    }
    public function saveCategoryProduct(Request $request) {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data);
        Session::put('message', "Thêm danh mục thành công");
        return Redirect::to('/add-category-product');

    }
    public function activeCategoryProduct( $category_product_id ) {
        DB::table('tbl_category_product')->where('category_id',  $category_product_id)->update(['category_status'=>1]);
        Session::put('message', "Category online");
        return Redirect::to('/all-category-product');
    }
    public function unactiveCategoryProduct( $category_product_id ) {
        DB::table('tbl_category_product')->where('category_id',  $category_product_id)->update(['category_status'=>0]);
        Session::put('message', "Category offline");
        return Redirect::to('/all-category-product');
    }
    public function editCategoryProduct( $category_product_id ) {
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->first();
        $manager_category_product = view('admin.edit-category-product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit-category-product', $manager_category_product);
    }
    public function updateCategoryProduct( Request $request, $category_product_id ) {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message', "Category $request->category_product_name update");
        return Redirect::to('/all-category-product');
    }
    public function deleteCategoryProduct( $category_product_id ) {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        return Redirect::to('/all-category-product');
    }
}
