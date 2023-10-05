<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial;
        }
        .coupon {
            border:5px dotted #bbb;
            width: 80%;
            border-radius: 15px;
            margin: 0 auto;
            max-width: 600px;
        }
        .container {
            padding: 2px 16px;
            background-color: #f1f1f1;
        }
        .promo {
            background: #ccc;
            padding: 3px;
        }
        .expire {
            color: red;
        }
        p.code {
            text-align: center;
            font-size: 20px;
        }
        p.expire {
            text-align: center;
        }
        h2.note {
            text-align: center;
            font-size: large;
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="coupon">
        <div class="container">
            <h3>Mã khuyến mãi từ shop <a href="http://shop.test" target="_blank">http://shop.test/</a></h3>
        </div>
        <div class="container" style="background-color:white;">
            @if ($coupon['coupon_condition'] ==1)
                <h2 class="note"><b><i>Giảm ngay {{$coupon['coupon_number']}}% cho đơn hàng trên 2 triệu</i></b></h2>
            @else
                <h2 class="note"><b><i>Giảm ngay {{number_format($coupon['coupon_number'], 0, '', '.')}}đ cho đơn hàng trên 2 triệu</i></b></h2>
            @endif

            <p>Quý khách đã từng mua hàng tại shop <a class="expire" href="http://shop.test"
                target="_blank">http://shop.test/</a> nếu có nhu cầu muốn mua hàng thì hãy nhập mã dưới đây để được giảm giá. Chúc
            quý khách thật nhiều sức khỏe và bình an trong cuộc sống. </p>
        </div>
        <div class="container">
            <p class="code">Sử dụng code sau <span class="promo">{{$coupon['coupon_code']}}</span> với chỉ {{$coupon['coupon_time']}} mã</p>
            <p class="expire">Ngày bắt đầu: {{$coupon['start_date']}} // Ngày hết hạn code: {{$coupon['end_date']}}</p>
        </div>
    </div>
</body>
</html>
