<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Revenue\RevenueService;
use App\Models\Revenue;
use App\Models\Product;
use App\Models\Blog;
use Carbon\Carbon;

class RevenueController extends Controller
{
    protected $revenueService;

    function __construct(RevenueService $revenueService)
    {
        $this->revenueService = $revenueService;
    }

    public function index() {
        $product_views = Product::orderBy('product_views','DESC')->take(20)->get();
        $blog_views = Blog::orderBy('blog_views','DESC')->take(20)->get();
        return view('admin.revenue.dashboard', [
            'title' => 'Tổng quan',
            'product_views' => $product_views,
            'blog_views' => $blog_views
        ]);
    }

    public function filter_by_date(Request $request) {
        $data = $request->all();

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Revenue::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();


        $chartdata[] = array();

        foreach($get as $key => $val) {
                $chartdata[] = [
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity,
                ]
            ;
        }

        echo $data = json_encode($chartdata);
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();

        // echo $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $dauthangnay = Carbon::now('Asia/Ho_Chi_minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_minh')->submonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_minh')->submonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_minh')->subdays(365)->toDateString();

        $now  = Carbon::now('Asia/Ho_Chi_minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay') {
            $get = Revenue::whereBetween('order_date', [$sub7days, $now])->orderBy('orderDate', 'ASC')->get();
        }
        else if ($data['dashboard_value'] == 'thangtruoc') {
            $get = Revenue::whereBetween('order_date', [$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('orderDate', 'ASC')->get();
        }
        else if ($data['dashboard_value'] == 'thangnay') {
            $get = Revenue::whereBetween('order_date', [$dauthangnay, $now])->orderBy('orderDate', 'ASC')->get();
        }
         else {
            $get = Revenue::whereBetween('order_date', [$sub365days, $now])->orderBy('orderDate', 'ASC')->get();
         }

         $chartData[] = array();

         foreach ($get as $key => $val) {
            $chartData[] = [
                'period' => val->order_date,
                'order'=> val->total_order,
                'sales'=> val->sales,
                'profit'=> val->profit,
                'quantity' => val->quantity
            ];
         }

         echo $data = json_encode($chartData);
    }
}
