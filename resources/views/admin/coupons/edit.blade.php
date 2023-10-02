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
                        <input type="text" name="coupon_name" value="{{$coupon->coupon_name}}" class="form-control"  >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Mã giảm giá</label>
                <input type="text" name="coupon_code" value="{{$coupon->coupon_code}}" class="form-control"  >
            </div>

            <div class="form-group">
                <label>Số lượng</label>
                <input type="text" name="coupon_time" value="{{$coupon->coupon_time}}" class="form-control"  >
            </div>

            <div class="form-group">
                <label>Tính năng mã</label>
                <select name="coupon_condition" id="">
                    <option value="0" {{ $coupon->coupon_condition == 0 ? 'selected' : '' }}>----Chọn----</option>
                    <option value="1" {{ $coupon->coupon_condition == 1 ? 'selected' : '' }}>Giảm theo %</option>
                    <option value="2" {{ $coupon->coupon_condition == 2 ? 'selected' : '' }}>Giảm theo tiền</option>
                </select>
            </div>


            <div class="form-group">
                <label>Nhập số % hoặc số tiền giảm</label>
                <input type="text" name="coupon_number" id="coupon_number" class="form-control" value="{{ $coupon->coupon_number }} " >
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật giảm giá</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
