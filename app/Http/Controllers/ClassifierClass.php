<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\photo;
class ClassifierController extends Controller
{
    public function store(Request $request)
    {
        if (!$request->file('photo')) {
            return redirect()->back()->withErrors(['error' => '사진을 첨부해주세요']);
        }

        /* model api 호출 */
        $url = env('model_api');
        $img = $request->file('photo'); # 파일 업로드
        $response = Http::attach(
            'image', file_get_contents($img), $img
        )->post($url); # 파일을 multipart 요청으로 전송

        /* api 서버와의 연결이 끊겼을 경우 */
        if ($response->json('cropName',JSON_UNESCAPED_UNICODE) == 256)
        {
            return redirect()->back()->withErrors(['error' => '서버와의 연결이 끊겼습니다']);
        }

        /* database store */
        $path = $request->file('photo')->store('public');
        $photo = Photo::create([
            'url' => Storage::url($path),
            'hashname' => $request->file('photo')->hashName(),
            'originalname' => $request->file('photo')->getClientOriginalName(),
            'cropName' => $response->json('cropName', JSON_UNESCAPED_UNICODE),
            'sickNameKor' => $response->json('sickNameKor', JSON_UNESCAPED_UNICODE) # 유니코드 한글 깨짐현상 JSON_UNESCAPED_UNICODE
        ]);

        return redirect()->back()->with([
            'id' => $photo->id,
            'status' => '정상적으로 업로드 되었습니다.'
        ]);

    }
}
