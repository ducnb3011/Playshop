@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
            $content = Cart::content();
            /*
            echo '<pre>';
            print_r($content);
            echo '<pre>';
            */
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản phẩm</td>
                        <td class="description"></td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $c_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/uploads/product/'.$c_content->options->image)}}"
                                    style="width: 100px;" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$c_content->name}}</a></h4>

                        </td>
                        <td class="cart_price">
                            <p>{{number_format($c_content->price)}}đ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{URL::to('/less-to-cart/'.$c_content->rowId)}}"> - </a>
                                <input class="cart_quantity_input" type="text" name="quantity"
                                    value="{{$c_content->qty}}" autocomplete="off" size="2">
                                <a class="cart_quantity_up" href="{{URL::to('/more-to-cart/'.$c_content->rowId)}}"> + </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($c_content->price * $c_content->qty)}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$c_content->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng tiền sản phẩm <span>{{Cart::subtotal().' vnđ'}}</span></li>
                        <li>Thuế <span>{{Cart::tax().' vnđ'}}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Tổng <span>{{Cart::total().' vnđ'}}</span></li>
                    </ul>
                    
                    <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
<!--/#cart_items-->

@endsection