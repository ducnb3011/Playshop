@extends('layout')
@section('content')

<div class="product-details">
    <!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <div class="image-box">
                <img src="{{URL::to('public/uploads/product/'.$detail_product->product_image)}}" alt="" />
                <h3>ZOOM</h3>
            </div>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <a href=""><img src="{{URL::to('public/frontend/images/girl1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{URL::to('public/frontend/images/girl2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{URL::to('public/frontend/images/girl3.jpg')}}" alt=""></a>
                </div>
                <div class="item">
                    <a href=""><img src="{{URL::to('public/frontend/images/girl2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{URL::to('public/frontend/images/girl3.jpg')}}" alt=""></a>
                    <a href=""><img src="{{URL::to('public/frontend/images/girl1.jpg')}}" alt=""></a>
                </div>
                <div class="item">
                    <a href=""><img src="{{URL::to('public/frontend/images/girl3.jpg')}}" alt=""></a>
                    <a href=""><img src="{{URL::to('public/frontend/images/girl1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{URL::to('public/frontend/images/girl2.jpg')}}" alt=""></a>
                </div>

            </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information">
            <!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$detail_product->product_name}}</h2>

            <img src="images/product-details/rating.png" alt="" />

            <form action="{{URL::to('/save-cart')}}" method="POST">
                {{ csrf_field() }}
            <span>
                <span>VN {{number_format($detail_product->product_price)}}đ</span>
                <label>Quantity:</label>
                <input name="qty" type="number" value="1" min="1" />
                <input name="productid_hidden" type="hidden" value="{{$detail_product->product_id}}" />
                <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm vào giỏ hàng
                </button>
            </span>
            </form>

            <p><b>Trạng thái:</b> còn hàng</p>
            <p><b>Tình trạng:</b> Mới</p>
            <p><b>Thương hiệu:</b> {{$detail_product->brand_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
        </div>
        <!--/product-information-->
    </div>
</div>
<!--/product-details-->
<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Hồ sơ công ty</a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh giá(5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" style="padding-left: 20px;">
            <h2>Description</h2>
            <p>{{$detail_product->product_desc}}</p>
            <h2>Detail</h2>
            <p>{{$detail_product->product_content}}</p>
        </div>

        <div class="tab-pane fade" id="companyprofile" style="padding-left: 20px;">
            <h2>{{$detail_product->brand_name}}</h2>
            <p>{{$detail_product->brand_desc}}</p>
        </div>

        <div class="tab-pane fade " id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name" />
                        <input type="email" placeholder="Email Address" />
                    </span>
                    <textarea name=""></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
<!--/category-tab-->

<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">Gợi ý sản phẩm</h2>
    @foreach($relate_product as $key => $relate)
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <div style="height: 80px;">
                    <img class="smallimg" src="{{URL::to('public/uploads/product/'.$relate->product_image)}}" alt="" />
                    </div>
                    <h2 style="height: 60px;">{{$relate->product_name}}</h2>
                    <p>VN {{number_format($relate->product_price)}}đ</p>
                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                        cart</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!--/recommended_items-->

@endsection