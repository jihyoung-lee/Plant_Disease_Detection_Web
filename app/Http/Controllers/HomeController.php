<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /* dashboard table 에 최신순으로 질병 분류 데이터 출력*/
    public function show(){
        $Photos = DB::table('photos')->latest()->paginate(5);
        return view('dashboard', ['Photos' => $Photos]);
    }
    /* 데이터 삭제*/
    public function delete($id){
        $Photos = DB::table('photos')->where('id','=',$id)->delete();
        return redirect('/');
    }
}
