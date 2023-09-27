<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Social;
use Socialite;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.login',[
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function login_facebook() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){

        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();

        if($account){
            //login in vao trang quan tri
            $account_name = User::where('id',$account->user)->first();
            Session::put('admin_login',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/admin')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $thinh = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = User::where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => ''
                ]);
            }
            $thinh->login()->associate($orang);
            $thinh->save();

            $account_name = User::where('id',$account->user)->first();

            Session::put('admin_login',$account_name->admin_name);
             Session::put('admin_id',$account_name->admin_id);
            return redirect('/admin')->with('message', 'Đăng nhập Admin thành công');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $request->input('remember'))) {
            // return route('admin');
            Session::flash('status', 'Đăng nhập thành công');
            return redirect()->route('admin');

        }
        Session::flash('error', 'Email hoặc mật khẩu không chính xác');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(c $c)
    {
        //
    }
}
