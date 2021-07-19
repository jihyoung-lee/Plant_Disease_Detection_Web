<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiseaseController extends Controller
{

    /*disease_list*/
    public function disease_list(Request $request)
    {
        /*request variable*/
        $serviceCode = "SVC01";
        $serviceType = "AA001:XML";
        $displayCount = 50;

        /*default search value*/
        $paramSearch = $request->input('search','사과');
        $paramStr =  "&cropName=";
        $type = 1;

        /*crop name*/
        if($request->input('type')==1){
            $paramSearch =  $request->input('search');
            $paramStr= "&cropName=";
            $type = 1;
        }

        /*sick name*/
        elseif ($request->input('type')==2)
        {
            $paramSearch = $request->input('search');
            $paramStr =  "&sickNameKor=";
            $type = 2;
        }

        /* param Url */
        $param = "&serviceCode=".$serviceCode."&serviceType=".$serviceType.$paramStr.$paramSearch."&displayCount=".$displayCount;
        $xml = $this->call_api($param);
        if($xml->totalCount != 0){
            $array = $xml->list;
            $json = json_decode( json_encode( $array ), 1 );

            $data = $json['item'] ;}
        # xml 배열이 비어있으면 빈 배열을 변수에 넣음
        else{
            $data = [];
        }
        $param = "&serviceCode=".$serviceCode."&serviceType=".$serviceType.$paramStr.$paramSearch."&displayCount=".$displayCount;


        /*pagination*/
        $CollectionObj = collect($data);
        $array = $this->paginate($CollectionObj);
        $array->withPath('/test/?search='.$paramSearch);


        return view('list.disease_list',compact('array','paramSearch','type'));

    }



}

