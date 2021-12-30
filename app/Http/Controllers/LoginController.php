<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request){

        $user = $request->only('user_id', 'password');

        if(Auth::attempt($user)){
            return redirect()->route('leaves.admin');
        }
        else{
            return redirect()->back()->with([
                'status' => '다시 입력해주세요']);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
