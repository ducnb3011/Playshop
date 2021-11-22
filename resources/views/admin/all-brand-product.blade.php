@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê danh mục sản phẩm
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <?php
            $message = Session::get('message');
            if($message) {
                echo $message;
                Session::put('message', null);
            }
        ?>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên nhãn hiệu</th>
                        <th>Hiển thị</th>
                        <th>Quản lý</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_brand_product as $key => $cate_pro)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $cate_pro->brand_name }}</td>
                        <td>
                            <?php 
                            if($cate_pro->brand_status == 0) {
                            ?>
                                <a href="{{URL::to('/active-brand-product/'.$cate_pro->brand_id)}}">
                                    <span class="fa fa-eye-slash text-danger" style="font-size: 28px; padding-left: 10px;"></span>
                                </a>
                            <?php
                            } else { 
                            ?>
                                <a href="{{URL::to('/unactive-brand-product/'.$cate_pro->brand_id)}}">
                                    <span class="fa fa-eye" style="font-size: 28px; padding-left: 10px;"></"></span>
                                </a>
                            <?php } 
                            ?>
                        </td>
                        <td>
                            <a href="{{URL::to('/edit-brand-product/'.$cate_pro->brand_id)}}" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active" style="padding-right: 20px"></i>
                            </a>
                            <a onclick = "return confirm('Bạn chắc chắn muốn xóa danh mục <?php echo $cate_pro->brand_name; ?>')"  
                            href="{{URL::to('/delete-brand-product/'.$cate_pro->brand_id)}}" class="active" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>

@endsection