@extends('main')

@section('content')
    <div class="bg0 m-t-23 p-b-140 p-t-80">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                   <h1>{{ $title }}</h1>
                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filter
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        {{-- <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" id="search-product" placeholder="Search"> --}}
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" id="search-button">
                            <a id="search-link"  href="">
                                <i class="zmdi zmdi-search"></i>
                            </a>
                        </button>

                        <input id ="search_input" onkeyup="search(this)" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Nhập tên sản phẩm">
                        <div id="search-ajax"></div>
                    </div>
                </div>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Sort By
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{ request()->url() }}" class="filter-link stext-106 trans-04">
                                        Default
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'asc', 'rating' => null]) }}" class="filter-link stext-106 trans-04">
                                        Price: Low to High
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'desc', 'rating' => null]) }}" class="filter-link stext-106 trans-04">
                                        Price: High to Low
                                    </a>
                                </li>
                            </ul>

                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Price
                            </div>

                            <ul>

                                <li class="p-b-6">
                                    {{-- <a href="#" class="filter-link stext-106 trans-04"> --}}
                                    <a href="{{ request()->fullUrlWithQuery(['from' => 0, 'to' => 5000]) }}" class="filter-link stext-106 trans-04">
                                        0 to 5,000
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['from' => 5000, 'to' => 10000]) }}" class="filter-link stext-106 trans-04">
                                        5000 to 10,000
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['from' => 10000, 'to' => 100000]) }}" class="filter-link stext-106 trans-04">
                                        10,000 to 100,000
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Stars
                            </div>

                            <ul>

                                <li class="p-b-6">
                                    {{-- <a href="#" class="filter-link stext-106 trans-04"> --}}
                                        <a href="{{ request()->fullUrlWithQuery(['rating' => 'asc', 'price' => null]) }}" class="filter-link stext-106 trans-04">
                                        Least to Most ✮
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['rating' => 'desc', 'price' => null]) }}" class="filter-link stext-106 trans-04">
                                        Most to Least ✮
                                    </a>
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>

            @include('products.prod_by_category')

            {!! $products->links() !!}
        </div>
    </div>
    <script>
       function search(element) {
            var inputValue = element.value;
            var newUrl = `{{ request()->fullUrlWithQuery(['search' => '']) }}${inputValue}`;
            // Lấy tham chiếu đến thẻ <a>
            var link = document.getElementById('search-link');
            // Cập nhật thuộc tính href của thẻ <a>
            link.setAttribute('href', newUrl);

            // auto complete
            // if (inputValue != '') {

            // }

       }

    </script>
@endsection

