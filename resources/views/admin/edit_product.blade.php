@extends('admin_layout')
@section('admin_content')

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật thông tin sản phẩm
        </header>
        <div class="panel-body">
            <?php
            $message = Session::get('message');
            if($message) {
                echo $message;
                Session::put('message', null);
            }
        ?>
            <div class="position-center">
                <form role="form" action="{{URL::to('/update-product/'.$edit_product->product_id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" value="{{$edit_product->product_name}}" class="form-control"
                            name="product_name" placeholder="">
                    </div>
                    <div>
                        <input style="display: none;" type="text" value="{{$edit_product->product_image}}"
                            class="form-control" name="product_old_image" placeholder="">
                    </div>
                    <div class="form-group" style="widht: 50%; float: left;">
                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="product_image" placeholder="">
                    </div>
                    <img src="{{URL::to('public/uploads/product/'.$edit_product->product_image) }}" 
                        style="width: 50%; margin-left: 50px;"
                        alt="public/uploads/product/Blogavatar.jpg">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="text" value="{{$edit_product->product_price}}" class="form-control"
                            name="product_price" placeholder="">
                    </div>
                    <div class="form-group" style="width: 48%; float: left;">
                        <label for="exampleInputPassword1">Danh mục</label>
                        <select class="form-control input-sm m-bot15" value="{{$edit_product->category_id}}"
                            name="product_category">
                            @foreach( $category_product as $key => $category )
                            @if($category->category_id == $edit_product->category_id)
                            <option selected value="{{$category->category_id}}">{{$category->category_name}}</option>
                            @else
                            <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="width: 48%; float: right;">
                        <label for="exampleInputPassword1">Nhãn hiệu</label>
                        <select class="form-control input-sm m-bot15" value="{{$edit_product->brand_id}}"
                            name="product_brand">
                            @foreach( $brand_product as $key => $brand )
                            @if($brand->brand_id == $edit_product->brand_id)
                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                            @else
                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea style="resize: none;" rows=8 type="text" class="form-control" name="product_desc">{{$edit_product->product_desc}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                        <textarea style="resize: none;" rows=8 type="text" class="form-control" name="product_content">{{$edit_product->product_content}}
                        </textarea>
                    </div>
                    <div>
                    <input style="display: none;" type="number" value="{{$edit_product->product_status}}" class="form-control" name="product_status" placeholder="">
                    </div>
                    <div>
                        <input style="display: none;" type="number" value="{{$edit_product->product_status}}"
                            class="form-control" name="product_status" placeholder="">
                    </div>
                    <button type="submit" name="update_product" class="btn btn-info">Cập nhật</button>
                </form>
            </div>

        </div>
    </section>

</div>

@endsection