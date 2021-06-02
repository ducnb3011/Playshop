@extends('admin_layout')
@section('admin_content')

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật nhãn hiệu
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
                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_brand_product->brand_id)}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên nhãn hiệu</label>
                        <input type="text" value="{{$edit_brand_product->brand_name}}" class="form-control" name="brand_product_name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả</label>
                        <textarea style="resize: none;" rows=8
                        type="text" class="form-control" name="brand_product_desc" >{{$edit_brand_product->brand_desc}}
                        </textarea>
                    </div>
                    <div>
                    <input style="display: none;" type="number" value="{{$edit_brand_product->brand_status}}" class="form-control" name="brand_product_status" placeholder="">
                    </div>
                    <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật</button>
                </form>
            </div>

        </div>
    </section>

</div>

@endsection