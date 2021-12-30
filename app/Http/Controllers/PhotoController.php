<?php

namespace App\Http\Controllers;
use App\Models\Train;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class PhotoController extends Controller
{
    public function show(){
        $DB = DB::table('train');
        $Photos = $DB->latest()->paginate(5);

        return view('dashboard', ['Photos' => $Photos]);
    }

    public function opinionStore(Request $request,$id): \Illuminate\Http\RedirectResponse
    {
        $cropName = $request->input('cropName');
        $sickNameKor = $request->input('sickNameKor');
        $userOpinion = $cropName.'_'.$sickNameKor;

        DB::table('train')->where('id','=',$id)->update(['userOpinion' => $userOpinion]);

        return redirect()->back()->with([
            'status' => '보내주신 의견은 검토 후 모델 재학습에 반영됩니다'
        ]);
    }

    public function store(Request $request)
    {

        if (!$request->file('photo')) {
            return redirect()->back()->withErrors(['error' => '사진을 첨부해주세요']);
        }

        $model = env('modelApi');

        /* api 서버 500 Bad Request*/
        if (Http::get($model)->serverError())
        {
         return redirect()->back()->withErrors(['error' => '서버와의 연결이 끊어졌습니다 잠시후에 다시 시도해주세요']);}


        else{

            $hashname =  md5_file($request->file('photo')->getRealPath());
            $train = DB::table('train')->where('hashname',$hashname);
            $validatedData = $request->validate([
                   'photo' => 'mimes:jpeg,bmp,png,jpg'
               ]);


            /* 중복데이터 검사 */
            if ($train->exists())
            {
                $photo = Train::create([
                    'url' =>$train->value('url'),
                    'hashname' => $hashname,
                    'originalname' => $train->value('originalname'),
                    'cropName' => $train->value('cropName'),
                    'sickNameKor' => $train->value('sickNameKor'),
                    'confidence' => $train->value('confidence')
                ]);

            }

            else {
                /* 파일 업로드 */

                $url = $model.'/predict';
                $response = Http::attach(
                    'image', file_get_contents($validatedData['photo']), $validatedData['photo']
                )->post($url); # 파일을 multipart 요청으로 전송

                $cropName = $response->json('cropName', JSON_UNESCAPED_UNICODE);# 유니코드 한글 깨짐현상 JSON_UNESCAPED_UNICODE
                $sickNameKor = $response->json('sickNameKor', JSON_UNESCAPED_UNICODE);
                $confidence = $response->json('confidence');
                $path = $request->file('photo')->store('public/'.$cropName.'_'.$sickNameKor,'s3'); # 모델 재학습을 위한 데이터 라벨링

                $photo = Train::create([
                    'url' => Storage::disk('s3')->url($path),
                    'hashname' => $hashname,
                    'originalname' => $request->file('photo')->getClientOriginalName(),
                    'cropName' => $cropName,
                    'sickNameKor' => $sickNameKor,
                    'confidence' => $confidence

                ]);
            }


        }

      return redirect()->back()->with([
            'id' => $photo->id,
            'status' => '정상적으로 업로드 되었습니다.'
        ]);

    }
}
