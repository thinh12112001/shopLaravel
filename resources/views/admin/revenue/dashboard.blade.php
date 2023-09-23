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
    </div>
</form>
@endsection


