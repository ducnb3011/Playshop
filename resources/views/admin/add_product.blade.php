@extends('admin_layout')
@section('admin_content')

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm sản phẩm
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
                <form role="form" action="{{URL::to('/save-product')}}" method="post" 
                enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="product_name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="product_image" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="text" class="form-control" name="product_price" placeholder="">
                    </div>
                    <div class="form-group" style="width: 48%; float: left;">
                        <label for="exampleInputPassword1">Danh mục</label>
                        <select class="form-control input-sm m-bot15" name="product_category">
                            @foreach( $category_product as $key => $category )
                            <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="width: 48%; float: right;">
                        <label for="exampleInputPassword1">Nhãn hiệu</label>
                        <select class="form-control input-sm m-bot15" name="product_brand">
                            @foreach( $brand_product as $key => $brand )
                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea style="resize: none;" rows=8
                         type="text" class="form-control" name="product_desc" >
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                        <textarea style="resize: none;" rows=8
                         type="text" class="form-control" name="product_content" >
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                        <select class="form-control input-sm m-bot15" name="product_status">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển thị</option>
                        </select>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                </form>
            </div>

        </div>
    </section>

</div>

@endsection