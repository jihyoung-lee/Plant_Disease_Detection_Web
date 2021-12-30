<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function index()
    {
    return view('signUp');
    }
    public function store(Request $request){

        $id = $request->input('user_id');
        $password = $request->input('password');
        $name = $request->input('name');

        User::create([
            'user_id'=>$id,
            'password' =>Hash::make($password),
            'name'=>$name
        ]);

        return redirect('/sign');
    }

}
