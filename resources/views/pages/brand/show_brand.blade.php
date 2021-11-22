@extends('layout')
@section('content')

<div class="features_items">
    <h2 class="title text-center">{{$brand_selected->brand_name}}</h2>
    @foreach($all_product as $key => $product)
    <a href="{{URL::to('/product-info/'.$product->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <div style="height: 250px; width: auto;">
                            <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}"
                                alt="Lỗi hiển thị" />
                        </div>
                        <h2>{{number_format($product->product_price)}} đ</h2>
                        <p>{{$product->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                            hàng</a>
                    </div>
                    
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>

@endsection