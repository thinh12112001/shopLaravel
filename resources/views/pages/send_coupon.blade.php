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
            <h2 class="note"><b><i>Giảm giá cho đơn hàng trên 2 triệu</i></b></h2>
            <p>Quý khách đã từng mua hàng tại shop <a class="expire" href="http://shop.test"
                target="_blank">http://shop.test/</a> nếu có nhu cầu muốn mua hàng thì hãy nhập mã dưới đây để được giảm giá. Chúc
            quý khách thật nhiều sức khỏe và bình an trong cuộc sống. </p>
        </div>
        <div class="container">
            <p class="code">Sử dụng code sau <span class="promo">BOH232</span></p>
            <p class="expire">Ngày hết hạn code: 30-11-2023</p>
        </div>
    </div>
</body>
</html>
