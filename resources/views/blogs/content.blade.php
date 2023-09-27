@extends('main')
@section('content')
<style>
    .content-container {
        width: 100%; /* Đảm bảo nội dung trải dài trong div */
        text-align: left; /* Căn lề nội dung về trái */
        margin: 0 auto; /* Căn giữa nội dung */

    }
    .content-container * {
        width: 100%; /* Width bằng với div cha (.content-container) */
        font-size: 20px;
        height: auto;
    }

    /* CSS cho tựa đề h1 */
    #blog_title {
        font-size: 2em; /* Kích cỡ chữ */
        font-weight: bold; /* Độ đậm của chữ */
        color: #000; /* Màu chữ */
        text-align: center; /* Căn giữa */
        margin-bottom: 20px; /* Khoảng cách với phần bên dưới */
    }
</style>

    <div class="container p-t-80">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            {{-- <a href="/danh-muc/{{ $blog->menu->id }}-{{ Str::slug($blog->menu->name) }}.html"
               class="stext-109 cl8 hov-cl1 trans-04">
                {{ $blog->menu->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a> --}}

            <span class="stext-109 cl4">
				{{ $title }}
			</span>
        </div>
    </div>

    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row" style="text-align:center;">
                <div class="p-l-25 p-r-30 p-lr-0-lg content-container">
                    <h1 id="blog_title" class="mtext-105 cl2 js-name-detail p-b-14">
                        <strong>{{ $title }}</strong>
                    </h1>
                    <div class="slick3 gallery-lb slick-initialized slick-slider slick-dotted">
                        <p>
                            {!!$blog->content!!}
                        </p>
                    </div>
                </div>

                    @include('admin.alert')
        </div>
    </section>


    <div class="bor10 m-t-50 p-t-43 p-b-40">
        <!-- Tab01 -->
        <div class="tab01">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Comments</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-t-43">



                <!-- - -->
                <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                            {{-- <div class="p-b-30 m-lr-15-sm"> --}}
                                    <style>
                                        .style_comment{
                                            border: 1px solid #ddd;
                                            border-radius: 10px;
                                            background: #F0F0E9;
                                        }
                                    </style>
                                    <form action="">
                                        @csrf
                                        <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$blog->id}}">
                                        <div id="comment_show"></div>

                                    </form>

                                <!-- Add review -->
                                <form class="w-full">
                                    <h5 class="mtext-108 cl2 p-b-7">
                                        Add a review
                                    </h5>

                                    <p class="stext-102 cl6">
                                        Your email address will not be published. Required fields are marked *
                                    </p>


                                    <div id="notify_comment"></div>
                                    <div class="row p-b-25">
                                        <div class="col-12 p-b-5">
                                            <label class="stext-102 cl3" for="comment">Your comment</label>
                                            <textarea class="comment_content size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                      id="comment" name="comment"></textarea>
                                        </div>

                                        <div class="col-sm-12 p-b-5">
                                            <label class="stext-102 cl3" for="name">Name</label>
                                            <input class="comment_name size-111 bor8 stext-102 cl2 p-lr-20" id="name"
                                                   type="text" name="name">
                                        </div>

                                        {{-- <div class="col-sm-6 p-b-5">
                                            <label class="stext-102 cl3" for="email">Email</label>
                                            <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                   type="text" name="email">
                                        </div> --}}
                                    </div>

                                    <button type="button"
                                        class="send-comment flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                        Submit
                                    </button>


                                </form>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related blogs
                </h3>
            </div>

            @include('blogs.list')
        </div>
    </section>

@endsection
