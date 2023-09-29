@extends('admin.main')

@section('content')
<form autocomplete="off" class="mt-4" action="" method="POST">
    @csrf
    <div class="container-fluid">
        <style type="text/css">
            p.title_thongke {
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }

            .horizontal-form-group {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .horizontal-form-group .form-group {
                width: 23%; /* Điều chỉnh độ rộng của mỗi form group */
            }

            .horizontal-form-group .form-group:last-child {
                width: 28%; /* Điều chỉnh độ rộng của button */
                margin-left: 2%; /* Tăng khoảng cách giữa các form group */
            }
            .button-container {
                margin-top: 30px; /* Khoảng cách từ top 10px */
            }
        </style>

        <div class="row">
            <div class="col-md-12">
                <p class="title_thongke">Thống kê doanh số</p>
            </div>

            <div class="col-md-12" style="display: flex; justify-content: center;">

                    <div class="horizontal-form-group">
                        <div class="form-group">
                            <label for="datepicker">Từ ngày</label>
                            <input type="text" id="datepicker" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="datepicker2">Đến ngày</label>
                            <input type="text" id="datepicker2" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="filterOption">Lọc theo:</label>
                            <select name="filterOption" id="filterOption" class="dashboard-filter form-control">
                                <option>--Chọn--</option>
                                <option value="7ngay">7 ngày</option>
                                <option value="thangtruoc">Tháng trước</option>
                                <option value="thangnay">Tháng này</option>
                                <option value="365ngayqua">365 ngày qua</option>
                            </select>
                        </div>

                        <div class="form-group button-container">
                            <input type="button" id="btn-dashboard-filter" class="btn btn-primary" value="Lọc kết quả">
                        </div>
                    </div>

            </div>

            <div class="col-md-12">
                <div id="chart" style="height: 250px;"></div>
            </div>

        </div>
        <hr>
    </div>
</form>

    <div class="row">
        {{-- <div class="col-md-4" col-xs-12>
            <p class="title-thongke">Thống kê tổng sản phẩm bài viết đơn hàng</p>
            <div id="donut"></div>
        </div> --}}
        <div class="col-md-8">
            <h3>Bài viết xem nhiều</h3>
            <ol class="list_views">
                @foreach ($blog_views as $key => $blog)
                    <li>
                        <a target="_blank" href="../../blog/detail/{{$blog->id}}-{{Str::slug($blog->name, '-') }}.html">{{$blog->name}}
                        | <span style="color:black;">{{$blog->blog_views}}</span></a>
                    </li>
                @endforeach
            </ol>
        </div>

        <div class="col-md-4">
            <style type="text/css">
                ol.list_views{
                    margin: 10px 0;
                    color: black;
                }
                ol.list_views a {
                    color: blue;
                    font-weight: 400;
                }
            </style>
            <h3>Sản phẩm xem nhiều</h3>
            <ol class="list_views">
                @foreach ($product_views as $key => $pro)
                    <li>
                        <a target="_blank" href="../../san-pham/{{$pro->id}}-{{Str::slug($pro->name, '-') }}.html">{{$pro->name}}
                        | <span style="color:black;">{{$pro->product_views}}</span></a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection


