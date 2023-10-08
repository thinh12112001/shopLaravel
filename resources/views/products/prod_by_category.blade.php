

@php
    use App\Models\Rating;
@endphp
<div class="row isotope-grid">
        @foreach ($products as $key => $product)
        @php
                $rating = Rating::where('product_id', $product->id)->avg('rating');
                $rating = round($rating);
                $reviewNums = Rating::where('product_id', $product->id)->count('rating');
                // dd($reviewNums);

        @endphp
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{$product->file}}" alt="IMG-PRODUCT">

                    <a href="#" data-toggle="modal" data-target="#xemnhanh" data-product_id="{{$product->id}}" name="add-to-cart"
                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04" onclick="quickView(this,'/quickview')">
                        Quick View
                    </a>

                    {{-- <input type="button" data-toggle="modal" data-target="#xemnhanh" value="Quick View" class="btn btn-default xemnhanh"
                    data-id_product="{{$product->id}}" name="add-to-cart"> --}}
                </div>

                <style>

                    .price_prodname a {
                        font-size: 20px;
                        font-weight: bold;
                        color: inherit;
                    }

                </style>
                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l price_prodname">
                        <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{$product->name}}
                        </a>

                        <span class="stext-105 cl3">
                            {!!number_format(\App\Helpers\Helper::price($product->price, $product->price_sale), 0, '', ',') !!}đ

                        </span>
                    </div>
                </div>
                {{-- test --}}
                <style>
                    .list-inline {
                        list-style: none; /* Loại bỏ kiểu đánh dấu (bullet points) của danh sách */
                        padding: 0; /* Loại bỏ padding */
                        margin: 0; /* Loại bỏ margin */
                    }

                    .list-inline li {
                        display: inline-block; /* Hiển thị các mục danh sách trên cùng một hàng */
                    }

                    .centered-list {
                        display: flex;
                        justify-content: space-between;
                    }

                    .centered-list ul {
                        flex: 1;
                        list-style-type: none;
                        padding: 0;
                    }

                    .centered-list span {
                        flex: 1;
                        display: flex;
                        align-items: center;
                    }
                </style>
                <div class="centered-list">
                    <ul class="list-inline" title="Average Rating">
                        @for ($count =1; $count <=5; $count++)
                            @php
                                if ($count <= $rating) {
                                    $color = 'color:#ffcc00;';
                                } else {
                                    $color = 'color:#ccc;';
                                }
                            @endphp
                            <li title="star_rating"
                                {{-- id="{{$product->id}}-{{$count}}"
                                data-index="{{$count}}"
                                data-product_id="{{$product->id}}"
                                data-rating="{{$rating}}"
                                class="rating" --}}
                                style="cursor:pointer; {{$color}} font-size:30px;">
                                &#9733;
                            </li>
                        @endfor
                    </ul>
                    <span> {{$reviewNums}} review</span>
                </div>
                {{-- test --}}
            </div>
        </div>
        @endforeach

    {{-- </form> --}}

    <!-- Modal QuickView -->
@if (is_null($products) == false )
<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header p-t-50" >
          <h5 class="modal-title"  id="product_quickview_title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <style type="text/css">
                span#product_quickview_content img {
                    width:  100%;
                }
                /* phone screen */
                @media screen and (min-width: 768px) {
                    .modal-dialog {
                        width: 250px;
                    }
                    .modal-sm {
                        width: 350px;
                    }
                }

                /* ipad screen >>>> */
                @media screen  and (min-width: 992px) {
                    .modal-lg {
                        width: 1200px;
                    }

                }
            </style>
          <div class="row">
            <div class="col-md-5">
                <span id="product_quickview_file"></span>

            </div>
            <div class="col-md-7">
                <h2 class="quickview"><span id="product_quickview_title"></span></h2>
                <p>Mã ID: <span id="product_quickview_id"></span></p>
                <p style="font-size: 20px; color: blue; font-weight: bold;">
                    Giá sản phẩm: <span id="product_quickview_price"></span>
                </p>

                {{-- <label>Số lượng: </label>
                <input type="number" name="qty" min=1 value="1"
                        class="cart_product_qty_" style="width: 50px;border: 1px solid #000000; outline: none;"> --}}


            <br/>
                <h4 style="font-size: 20px; color: blue;font-weight:bold ">Mô tả sản phẩm</h4>
                <hr>
                <p><span id="product_quickview_description"></p>
                    <p><span id="product_quickview_content"></p>
                </span>
                <span>

                    {{-- <input type="hidden" name="productid_hidden" value="{{$product->id}}"> --}}
                </span>

            </div>
          </div>
        </div>
        <style>
            .modal-footer {
                display: flex;
                justify-content: space-between;
                align-items: flex-end; /* Các phần tử con sẽ căn dưới cùng của div */
            }

            /* CSS để di chuyển nút "Close" vào góc trái dưới cùng */
            .btn-danger {
                margin: 0; /* Đặt margin về 0 để không có khoảng trắng xung quanh nút "Close" */
            }
        </style>
        <div class="modal-footer">
            <div class="col-md-9">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>


          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          <div class="col-md-3">
            <form id="addToCartForm" method="post">
                    {{-- @if ($product->price !== NULL) --}}
                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                <i class="fs-16 zmdi zmdi-minus"></i>
                            </div>

                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                name="num_product" min="1" value="1">

                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m ">
                                <i class="fs-16 zmdi zmdi-plus"></i>
                            </div>
                        </div>


                        <button type="button" onclick="addToCart()"
                                class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
                            Add to cart
                        </button>
                        <input type="hidden" id ='id-product-quickview' name="product_id"  value="">
                    {{-- @endif --}}
                @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<script>
// Lưu trạng thái
    localStorage.setItem('scrollPosition', window.scrollY);

        // giữ lại phần item từ load more
    // const loadedItems = JSON.parse(localStorage.getItem('loadedItems')) || [];
    // if (loadedItems.length > 0) {
    //     $('#loadProduct').append(loadedItems.join(''));
    // }


    // Khôi phục trạng thái sau khi tải lại trang
    window.onload = function() {
        const scrollPosition = localStorage.getItem('scrollPosition');

        if (scrollPosition) {
            window.scrollTo(0, scrollPosition);
            localStorage.removeItem('scrollPosition');
        }
    };

    function addToCart() {
        var form = document.getElementById('addToCartForm');
        var formData = new FormData(form);

        $.ajax({
            url: '/add-cart-main-page', // Đường dẫn đến controller để xử lý dữ liệu
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Xử lý kết quả từ controller (nếu cần)
                // console.log(loadedItems);
                location.reload();
                // console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

</script>

