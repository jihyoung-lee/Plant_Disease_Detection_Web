<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeavesController extends Controller
{
    //병해충 리스트 API
    public function BlightList()
    {
        //서비스키
        $apiKey = env('apiKey');
        //요청변수들
        $serviceCode = "SVC01";
        $serviceType = "AA001";
        $sickNameKor = "검은별무늬병";
        //XML 받을 URL 생성
        $parameter = "apiKey=" . $apiKey;
        $parameter .= "&serviceCode=";
        $parameter .= $serviceCode;
        $parameter .= "&serviceType=";
        $parameter .= $serviceType;
        $parameter .= "&sickNameKor=";
        $parameter .= $sickNameKor;


        $url = "http://ncpms.rda.go.kr/npmsAPI/service?" . $parameter;

        $test = Http::get($url);
        $xml = simplexml_load_string($test);
        $array = $xml->list;
        return view('', ['array' => $array]);

    }
}

