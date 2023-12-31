{{-- @php
    $menusHtml = \App\Helpers\Helper::menus($menus);
@endphp --}}
    <!-- Chatbox Realtime -->
    {{-- <style>
        #chat-box {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 300px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
}
.chat-box {
  width: 300px; /* Adjust the width of the chat box as needed */
  height: 300px; /* Adjust the height of the chat box as needed */
  background-color: #f2f2f2;
  display: none; /* Hide the chat box by default */
}

.chat-header {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  background-color: #4CAF50;
  color: #fff;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

.avatar {
  font-weight: bold;
}

.close-btn {
  cursor: pointer;
}

.chat-body {
  padding: 10px;
  overflow-y: auto;
  max-height: 200px;
}

.message {
  margin-bottom: 10px;
}

.chat-footer {
  display: flex;
  padding: 10px;
  border-top: 1px solid #ccc;
}

.message-input {
  flex: 1;
  padding: 10px;
  border-radius: 5px;
  margin-right: 10px;
}

.send-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

.send-btn:hover {
  background-color: #45a049;
}

.avatar-display .chat-content {
  display: none;
}

.avatar-display .avatar {
  cursor: pointer;
}

.chat-display .avatar {
  cursor: pointer;
}

.chat-display .chat-content {
  display: block;
}

.avatar {
  background-color: #3498db;
  color: white;
  text-align: center;
  line-height: 50px;
  cursor: pointer;
  border-radius: 10px;
  padding: 0 20px;
  width: 100%; /* Set width to 100% */
  box-sizing: border-box; /* Ensure padding is included in the width */
}

.avatar:hover {
  background-color: #2980b9;
}

/* Style for the expanded chat box */
.avatar-display {
  display: inline-block;
}

.chat-content {
  width: auto; /* Initially set to auto */
  background-color: #f2f2f2;
  display: none; /* Hide the chat box by default */
  border-radius: 10px;
  overflow: hidden; /* Hide overflowing content */
}


    </style>

<div id="chat-box" class="avatar-display">
    <div class="avatar" onclick="toggleChatBox()">Message</div>
    <div class="chat-content">
      <div class="chat-header">
        <div class="avatar">Admin</div>
        <div class="close-btn" onclick="toggleChatBox()">×</div>
      </div>
      <div class="chat-body">
        <div class="message">Welcome to the chat!</div>
        <!-- More messages go here -->
      </div>
      <div class="chat-footer">
        <textarea class="message-input" placeholder="Type your message..."></textarea>
        <button class="send-btn">Send</button>
      </div>
    </div>
  </div> --}}

<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>
                    {{-- {!! $menusHtml !!} --}}
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Women
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Men
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Shoes
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Watches
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Help
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Track Order
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Returns
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Shipping
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    GET IN TOUCH
                </h4>

                <p class="stext-107 cl7 size-201">
                    Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
                </p>

                <div class="p-t-27">
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-pinterest-p"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <div class="flex-c-m flex-w p-b-18">
                <a href="#" class="m-all-1">
                    <img src="{{ asset('template/images/icons/icon-pay-01.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('template/images/icons/icon-pay-02.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('template/images/icons/icon-pay-03.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('template/images/icons/icon-pay-04.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('template/images/icons/icon-pay-05.png') }}" alt="ICON-PAY">
                </a>
            </div>

            <p class="stext-107 cl6 txt-center">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </p>
        </div>
    </div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<!-- Modal1 -->
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal1"></div>

    <div class="container">
        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                <img src="{{ asset('template/images/icons/icon-close.png') }}" alt="CLOSE">
            </button>

            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{ asset('template/images/product-detail-01.jpg') }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ asset('template/images/product-detail-01.jpg') }}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="{{ asset('template/images/product-detail-02.jpg') }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ asset('template/images/product-detail-02.jpg') }}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="{{ asset('template/images/product-detail-03.jpg') }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ asset('template/images/product-detail-03.jpg') }}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('template/images/product-detail-03.jpg') }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            Lightweight Jacket
                        </h4>

                        <span class="mtext-106 cl2">
                            $58.79
                        </span>

                        <p class="stext-102 cl3 p-t-23">
                            Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Size
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="time">
                                            <option>Choose an option</option>
                                            <option>Size S</option>
                                            <option>Size M</option>
                                            <option>Size L</option>
                                            <option>Size XL</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Color
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="time">
                                            <option>Choose an option</option>
                                            <option>Red</option>
                                            <option>Blue</option>
                                            <option>White</option>
                                            <option>Grey</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Chat box --}}
<script>
    function toggleChatBox() {
  const chatBox = document.getElementById('chat-box');
  chatBox.classList.toggle('avatar-display');
  chatBox.classList.toggle('chat-display');
}
</script>
<!--===============================================================================================-->
    <script src="{{ asset('template/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('template/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/select2/select2.min.js') }}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('template/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/slick/slick.min.js') }}"></script>
	<script src="{{ asset('template/js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/parallax100/parallax100.js') }}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/isotope/isotope.pkgd.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/sweetalert/sweetalert.min.js') }}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

	</script>
<!--===============================================================================================-->
	<script src="{{ asset('template/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('template/js/main.js') }}"></script>
	<script src="{{ asset('template/js/public.js') }}"></script>
    <script src="{{ asset('template/website/js/main.js') }}"></script>
    <script>
        // comment
        $(document).ready(function() {

            load_comment();

            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name=_token]').val();

                $.ajax({
                    url: '/load-comment',
                    method: "POST",
                    data: {product_id: product_id, _token: _token},

                    success:function(data) {
                        $('#comment_show').html(data);
                    }
                })
            }

            $('.send-comment').click(function() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name=_token]').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();

                if (comment_name.trim() !== '' && comment_content.trim() !== '') {
                    $.ajax({
                    url: '/send-comment',
                    method: "POST",
                    data: {product_id: product_id,
                            comment_name: comment_name,
                            comment_content: comment_content,
                            _token: _token},

                        success:function(data) {

                            $('#notify_comment').html('<p class="text text-success">Thêm bình luận thành công! Đang chờ quản trị viên duyệt...</p>');
                            load_comment();
                            $('#notify_comment').fadeOut(9000);
                            $('.comment_name').val('');
                            $('.comment_content').val('');

                        }
                    })
                } else {
                    alert('Bạn phải nhập đầy đủ thông tin mới được bình luận!');
                }

            })

            function remove_background(product_id){
                for (let count =1; count <=5; count++) {
                    $('#'+product_id+'-'+count).css('color', "#ccc");
                }
            }

            $(document).on('mouseenter', '.rating', function() {
                var index = $(this).data("index");
                var product_id = $(this).data("product_id");

                remove_background(product_id);

                for (let count =1; count <= index; count++) {
                    $('#'+product_id+'-'+count).css('color', "#ffcc00");
                }
            });

            $(document).on('mouseleave', '.rating', function() {
                var index = $(this).data("index");
                var product_id = $(this).data("product_id");
                var rating = $(this).data("rating");

                remove_background(product_id);

                for (let count =1; count <= rating; count++) {
                    $('#'+product_id+'-'+count).css('color', "#ffcc00");
                }
            });

            $(document).on('click', '.rating', function() {
                var index = $(this).data("index");
                var product_id = $(this).data("product_id");
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '/insert-rating',
                    method: "POST",
                    data: {rating: index, product_id: product_id, _token : _token},

                    success:function(data) {
                        if (data == "done") {
                            alert('Bạn đã đánh giá '+index+" trên 5 sao!");
                        } else {
                            alert("lỗi đánh giá");
                        }
                    }
                });
            });
        });
    </script>

    @if(Request::is('carts') && session()->has('carts'))
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
        <script>
            var usd = $('#vnd_to_usd').val() === undefined ? 0 : $('#vnd_to_usd').val();

            paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'AWVzlzdxAWQKN9EFBFmyCgMErrZ0Ed2FXtEDL13B4zbtsVo30QWtLsky2Khsbg1T7p1DG9fQqTAI4eza',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'medium',
                color: 'gold',
                shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                return actions.payment.create({
                transactions: [{
                    amount: {
                    total: `${usd}`,
                    currency: 'USD'
                    }
                }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var totalValue = $('#vnd_to_usd').val();
                return actions.payment.execute().then(function() {
                    // Show a confirmation message to the buyer
                    var form = document.createElement('form');
                        form.setAttribute('method', 'POST');
                        form.setAttribute('action', '/paypal');

                    // Add CSRF token to the form data
                    var csrfInput = document.createElement('input');
                        csrfInput.setAttribute('type', 'hidden');
                        csrfInput.setAttribute('name', '_token');
                        csrfInput.setAttribute('value', csrfToken);
                        form.appendChild(csrfInput);

                    var totalInput = document.createElement('input');
                        totalInput.setAttribute('type', 'hidden');
                        totalInput.setAttribute('name', 'total');
                        totalInput.setAttribute('value', totalValue);
                        form.appendChild(totalInput);

                    document.body.appendChild(form);
                    form.submit(); //post method
                    // window.location.href = '../paypal'; // get method
                });
            }
            }, '#paypal-button');

        </script>
      @endif
    @yield('footer')
