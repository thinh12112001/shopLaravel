@extends('main')

@section('content')

<form class="bg0 p-t-130 p-b-85" method="POST">
    @include('admin.alert')
    @if (count($products) != 0)
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        @php
                            $total = 0;
                        @endphp
                        <table class="table-shopping-cart">
                            <tbody>
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                                <th class="column-6">&nbsp;</th>
                            </tr>
                            @foreach ($products as $key => $product )
                            @php
                                $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                $priceEnd = $price * $carts[$product->id];
                                $total += $priceEnd;
                            @endphp

                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{$product->file}}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{$product->name}}</td>
                                <td class="column-3">{{number_format($price, 0, '', ',')}}</td>
                                <td class="column-4">
                                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                            name="num_product[{{$product->id}}]" value="{{$carts[$product->id]}}">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="column-5">{{number_format($priceEnd, 0, '', ',')}}</td>
                                <td class="p-r-15">
                                    <a href="/carts/delete/{{$product->id}}">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            {{-- <form method="POST" action="check_coupon"> --}}
                                @csrf
                                <input  class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
                                {{-- <input href="" class=" check_out"> --}}
                                <input formaction="/check_coupon" type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Apply coupon" style="margin-right: 10px;">
                                @if (Session::get('coupon'))
                                    <input formaction="/remove_coupon" type="submit" class="btn btn-danger remove_coupon" name="remove_coupon" value="Remove coupon">
                                @endif
                            {{-- </form> --}}
                        </div>

                        <input type="submit" value="Update Cart" formaction="/update-cart"
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                        @csrf
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Tổng tiền
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Tổng tiền:
                            </span>
                        </div>


                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                {{number_format($total, 0, '', ',')}}
                            </span>
                        </div>
                        <div>
                            <li>
                                @if (Session::get('coupon'))
                                    @foreach (Session::get('coupon') as $key => $count )
                                        @if ($count['coupon_condition'] ==1)
                                            Mã giảm: {{$count['coupon_number']}}%
                                            <p>
                                                @php
                                                    $total_coupon = ($total * $count['coupon_number']) /100;

                                                    echo '<p>Tổng giảm: ' . number_format($total_coupon, 0, '', ',') .'đ</p>';
                                                    $total = $total - $total_coupon;
                                                    unset($key);
                                                @endphp
                                            </p>
                                            <p>Tổng đã giảm: {{number_format($total, 0, '', ',')}}</p>

                                        @endif
                                    @endforeach

                                @endif
                            </li>
                        </div>
                    </div>


                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">


                        <div class="size-100 p-r-18 p-r-0-sm w-full-ssm" style="width: 100%">


                            <div class="p-t-15" >
                                <span class="stext-112 cl8">
                                    <h4>Thông tin khách hàng</h4>
                                </span>

                                <hr>



                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" value="{{ old('name') }}" name="name" placeholder="Tên khách hàng" required>
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="number" value="{{ old('phone') }}" name="phone" placeholder="Số điện thoại" required>
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" value="{{ old('address') }}" name="address" placeholder="Địa chỉ" required>
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" value="{{ old('email') }}" name="email" placeholder="Email liên hệ" required>
                                </div>

                                <div class="bor8 bg0 m-b-12">
                                    <textarea class="cl8 plh3 size-111 p-lr-15" name="content" value="{{ old('content') }}" placeholder="Ghi chú" ></textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="total" value="{{ $total }}">
                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Đặt hàng
                    </button>
                <br/>
                    <div class="col-md-12">
                        @if (isset($total))
                              @php
                                   $vnd_to_usd = $total / 24144;
                                    // echo round($vnd_to_usd,2);
                              @endphp
                        @endif
                        <div style="text-align: center;" id="paypal-button"></div>
                        <input type="hidden" id="vnd_to_usd" value="{{round($vnd_to_usd,2)}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="text-center"><h2>Giỏ hàng trống</h2></div>
    @endif
</form>

@endsection

