<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\users;

use Socialite;
use Session;


//khai bao formRequest
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo, $provider);
        Auth::login($user);
        //auth()->login($user);
        return redirect()->to('/client');
    }

    function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => 'quang@gmail.com',
                'password' => '',
                'Role' => 0,
                'Isdelete' => false,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }

    function index()
    {
        return view('Client.home.Login');
    }

    function checklogin(LoginRequest $request)
    {
        $request->validated();
        $name = $request['name'];
        $password = $request['password'];
        if (Auth::attempt([
            'name' => $name,
            'password' => $password,
            'role' => false,
            'isdelete' => false,
            'provider' => '',
            'provider_id' => ''
        ])) {
            return redirect('client/')->with('message', 'Đã đăng nhập thành công');;
        }
        if (Auth::attempt(['name' => $name, 'password' => $password, 'role' => true])) {
            return redirect('Admin/Admin')->with('message', 'Đã đăng nhập Admin thành công');;
        } else {
            return back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
        }

    }

    function logout()
    {
        Auth::logout();
        return redirect('client/')->with('message', 'Bạn đã đăng xuất thành công');
    }


}

