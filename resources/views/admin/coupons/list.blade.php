@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr style="text-align: center; vertical-align: middle;">
            <th style="width: 50px">ID</th>
            <th>Tên mã giảm</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Mã giảm giá</th>
            <th>Số lượng mã</th>
            <th>Tỉ lệ giảm</th>
            <th>Tính năng mã</th>
            <th>Tình trạng mã</th>
            <th>Hết hạn</th>
            <th>Gửi mã</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($coupons as $key => $coupon)
            <tr style="text-align: center; vertical-align: middle;">
                <td>{{ $coupon->coupon_id }}</td>
                <td>{{ $coupon->coupon_name }}</td>
                <td>{{ $coupon->coupon_date_start }}</td>
                <td>{{ $coupon->coupon_date_end }}</td>
                <td>{{ $coupon->coupon_code }}</td>

                <td>{{ $coupon->coupon_time }}</td>
                <td>{{ $coupon->coupon_number }}</td>
                <td>{{ $coupon->coupon_condition == 1 ? "Giảm theo %" : "Giảm theo tiền" }}</td>
                <td>
                    @if ($coupon->coupon_status == 1)
                        <input type="button" data-comment_status="0" data-comment_id="{{$coupon->coupon_id}}"
                        class="btn btn-primary btn-xs" value="ON">
                    @else
                        <input type="button" data-coupon_status="1" data-coupon_id="{{$coupon->coupon_id}}"
                            class="btn btn-danger btn-xs" value="OFF">
                    @endif
                </td>
                <td>

                    @if ($coupon->coupon_date_end >= $today)
                        <span style="color:green;">Còn hạn</span>
                    @elseif ($coupon->coupon_date_end < $today)
                        <span style="color:red;">Hết hạn</span>
                    @endif
                </td>
                <td>
                    <p style="padding-left: 10px "><a href="{{url('/send-mail-vip',
                        ['start_date' => $coupon->coupon_date_start,
                        'end_date' => $coupon->coupon_date_end,
                        'coupon_time' => $coupon->coupon_time,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                        'coupon_code' => $coupon->coupon_code] )}}"
                        class="btn btn-primary btn-sm" style="margin: 5px 0;">Gửi cho khách VIP</a></p>
                    <p style="padding-left: 10px "><a href="{{url('/send-mail',
                        ['start_date' => $coupon->coupon_date_start,
                        'end_date' => $coupon->coupon_date_end,
                        'coupon_time' => $coupon->coupon_time,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                        'coupon_code' => $coupon->coupon_code] )}}"
                        class="btn btn-default btn-sm" >Gửi cho khách thường</a></p>

                </td>
                <td >
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
<hr>


    <div class="card-footer clearfix">
        {!! $coupons->links('pagination::bootstrap-4') !!}
    </div>
@endsection

