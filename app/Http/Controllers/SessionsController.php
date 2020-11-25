<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create'],
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|',
        ]);

        if (Auth::attempt($credentials)) {
            // 登陆成功
            session()->flash('success', '欢迎回来！');

            return redirect()->intended(route('users.show', [Auth::user()]));
        } else {
            // 登陆失败
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配！');

            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');

        return redirect('login');
    }
}
