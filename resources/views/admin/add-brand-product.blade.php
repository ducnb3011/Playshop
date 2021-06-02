@extends('admin_layout')
@section('admin_content')

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm nhãn hiệu
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
                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên nhãn hiệu</label>
                        <input type="text" class="form-control" name="brand_product_name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả</label>
                        <textarea style="resize: none;" rows=8
                         type="text" class="form-control" name="brand_product_desc"
                            id="exampleInputPassword1">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hiển thị</label>
                        <select class="form-control input-sm m-bot15" name="brand_product_status">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển thị</option>
                        </select>
                    </div>
                    <button type="submit" name="add_brand_product" class="btn btn-info">Thêm</button>
                </form>
            </div>

        </div>
    </section>

</div>

@endsection