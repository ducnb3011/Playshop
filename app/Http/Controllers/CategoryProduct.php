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
        /*
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        */
    }
}
