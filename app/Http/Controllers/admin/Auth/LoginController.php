<?php

namespace App\Http\Controllers\admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Rules\PasswordMatch;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
        View()->share('v', config('app.vadmin'));
    }
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.index')->with('notify_message', 'You are already logged in as Admin');
        }
        return view('admin.login.login')->with('title', 'Login Admin');
    }
    public function performLogin(AdminLoginRequest $request, MessageBag $message_bag)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.config')->with('notify_message', 'You are already logged in as Admin');
        }
        $validator = $request->validated();
        $user = Admin::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
            $message_bag->add('password', 'Invalid Password');
            return redirect()->route('admin.login')->withInput($request->input())->withErrors($message_bag);
        }
        $remember = 0;
        if (isset($request->remember)) {
            $remember = 1;
        }
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route('admin.index')->with('notify_message', 'Welcome to Admin ' . config('app.vadmin'));
        } else {
            return redirect()->route('admin.login')->withInput($request->input());
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
