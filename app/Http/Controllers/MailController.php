<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use Mail;

class MailController extends Controller
{
    public function send_mail_vip($start_date, $end_date, $coupon_time, $coupon_condition, $coupon_number,$coupon_code, Request $request) {
        try {

            $customer_vip = Customer::where('customer_vip', 1)
                                    ->distinct()
                                    ->pluck('email');
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $title_mail = "Mã khuyến mãi ngày ". $now;

            $data =[];
            foreach ($customer_vip as $vip) {
                $data['email'][] = $vip;
            }
            $coupon = array(
                'start_date' => $start_date,
                'end_date' => $end_date,
                'coupon_time' => $coupon_time,
                'coupon_condition' => $coupon_condition,
                'coupon_number' => $coupon_number,
                'coupon_code' => $coupon_code
            );

            Mail::mailer('coupon')->send('pages.send_coupon_vip', ['coupon' => $coupon], function ($message) use ($data, $title_mail) {
                $message->to($data['email'])
                        ->subject($title_mail)
                        ->from($data['email'], $title_mail);
                });

            $request->session()->flash('success', 'Gửi thành công');
            return redirect()->back();
        }
        catch(\Exception $err) {
            \Log::info($err->getMessage());
            $request->session()->flash('error', 'Gửi thất bại');
            return redirect()->back();
        }

    }

    public function send_mail ($start_date, $end_date, $coupon_time, $coupon_condition, $coupon_number,$coupon_code, Request $request) {
        try {
            $customer = Customer::whereNot('customer_vip', 1)
                                    ->distinct()
                                    ->pluck('email');
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $title_mail = "Mã khuyến mãi ngày ". $now;

            $data =[];
            foreach ($customer as $cus) {
                $data['email'][] = $cus;
            }
            $coupon = array(
                'start_date' => $start_date,
                'end_date' => $end_date,
                'coupon_time' => $coupon_time,
                'coupon_condition' => $coupon_condition,
                'coupon_number' => $coupon_number,
                'coupon_code' => $coupon_code
            );

            Mail::mailer('coupon')->send('pages.send_coupon',  ['coupon' => $coupon], function ($message) use ($data, $title_mail) {
                $message->to($data['email'])
                        ->subject($title_mail)
                        ->from($data['email'], $title_mail);
                });

            $request->session()->flash('success', 'Gửi thành công');
            return redirect()->back();
        }
        catch(\Exception $err) {
            \Log::info($err->getMessage());
            $request->session()->flash('error', 'Gửi thất bại');
            return redirect()->back();
        }
    }

    public function mail_example() {
        return view('pages.send_coupon');
    }
}
