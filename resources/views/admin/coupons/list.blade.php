@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tên mã giảm</th>
            <th>Mã giảm giá</th>
            <th>Số lượng mã</th>
            <th>Số lượng giảm (% hoặc số tiền)</th>
            <th>Tính năng mã</th>

            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($coupons as $key => $coupon)
            <tr>
                <td>{{ $coupon->coupon_id }}</td>
                <td>{{ $coupon->coupon_name }}</td>
                <td>{{ $coupon->coupon_code }}</td>

                <td>{{ $coupon->coupon_time }}</td>
                <td>{{ $coupon->coupon_number }}</td>
                <td>{{ $coupon->coupon_condition == 1 ? "Giảm theo %" : "Giảm theo tiền" }}</td>

                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/coupons/edit/{{ $coupon->coupon_id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow({{ $coupon->coupon_id }}, '/admin/coupons/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $coupons->links('pagination::bootstrap-4') !!}
    </div>
@endsection

