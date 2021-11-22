<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Session;
session_start();

class CartController extends Controller
{
    public function saveCart(Request $request) {       
        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $product = DB::table('tbl_product')->where('product_id', $productId)->first();
        $all_brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','desc')->get();
        $all_banner = DB::table('tbl_banner')->orderby('banner_id','asc')->get();

        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        //Cart::destroy();
        
        $data['id'] = $product->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product->product_name;
        $data['price'] = $product->product_price;
        $data['weight'] = $product->product_price;
        $data['options']['image'] = $product->product_image;
        Cart::add($data);
        
        return Redirect::to('/show-cart');
        /*
        echo '<pre>';
        print_r($data);
        echo '<pre>';
        */
    } 
    public function showCart() {
        $all_brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        $all_category_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','desc')->get();
        $all_banner = DB::table('tbl_banner')->orderby('banner_id','asc')->get();
        return view('pages.cart.show_cart')->with('category_product', $all_category_product)->with('brand_product', $all_brand_product)
        ->with('all_banner', $all_banner);
    }
    public function deleteToCart($rowId) {
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }
    public function moreToCart($rowId) {
        $product = Cart::get($rowId);
        $newQty = $product->qty + 1;
        Cart::update($rowId, $newQty);
        return Redirect::to('/show-cart');
    }
    public function lessToCart($rowId) {
        $product = Cart::get($rowId);
        $newQty = $product->qty - 1;
        Cart::update($rowId, $newQty);
        return Redirect::to('/show-cart');
    }
}
