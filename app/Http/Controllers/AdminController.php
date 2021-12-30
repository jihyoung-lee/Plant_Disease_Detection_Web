<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function admin(){
        $train = DB::table('train')->latest()->paginate(5);

        return view('admin/admin', ['train' => $train]);
    }

    public function delete($id){
        DB::table('train')->where('id','=',$id)->delete();

        return redirect('admin/admin');
    }


    public function adminUpdate($id){
        DB::table('train')->where('id','=',$id)->update(['modify'=>1]);

        # 데이터베이스 값
        $cropName = DB::table('train')->where('id','=',$id)->value('cropName');
        $sickNameKor = DB::table('train')->where('id','=',$id)->value('sickNameKor');
        $url = $cropName.'_'.$sickNameKor;

        #파일 경로 슬라이스
        $filename = DB::table('train')->where('id','=',$id)->value('url');
        $userOpinion = DB::table('train')->where('id','=',$id)->value('userOpinion');
        $class = class_basename($filename);
        Storage::disk('s3')->move('public/'.$url.'/'.$class, 'public/'.$userOpinion.'/'.$class);
        $slice = Str::before($filename, '/public/');
        $urlUpdate =$slice.'/public/'.$userOpinion.'/'.$class;

        DB::table('train')->where('id','=',$id)->update(['url' => $urlUpdate]);
        DB::table('train')->where('id','=',$id)->update(['modify'=>1]);

        return redirect()->back()->with([
            'status' => '수정완료'
        ]);
    }
}
