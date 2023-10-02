@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="menu">Tên mã giảm giá</label>
                        <input type="text" name="coupon_name" value="{{ old('coupon_name') }}" class="form-control"  >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Mã giảm giá</label>
                <input type="text" name="coupon_code" value="{{ old('coupon_code') }}" class="form-control"  >
            </div>

            <div class="form-group">
                <label>Số lượng</label>
                <input type="text" name="coupon_time" value="{{ old('coupon_time') }}" class="form-control"  >
            </div>

            <div class="form-group">
                <label>Tính năng mã</label>
                <select name="coupon_condition" id="">
                    <option value="0">----Chọn----</option>
                    <option value="1">Giảm theo %</option>
                    <option value="2">Giảm theo tiền</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nhập số % hoặc số tiền giảm</label>
                <input type="text" name="coupon_number" id="coupon_number" class="form-control" value="{{ old('coupon_number') }} " >
            </div>


            {{-- <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div> --}}
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm mã giảm giá</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
