<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class DiseaseController extends Controller
{

    /*disease_list*/
    public function index(Request $request)
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

        /* json 구조가 달라 따로 처리*/
        if($xml->totalCount > 1){
            $array = $xml->list;
            $json = json_decode( json_encode( $array ), 1 );
            $data = $json['item'] ;
        }
        /* xml 배열이 비어있으면 빈 배열을 변수에 넣음 */
        elseif($xml->totalCount=1){
            $array = $xml->list->item;
            $data = json_decode( json_encode( $array ), 1 );
        }
        else{
            $data = [];
        }

        /*pagination*/
        $CollectionObj = collect($data);
        $array = $this->paginate($CollectionObj);
        $array->withPath('/test/?search='.$paramSearch);

        return view('board',compact('array','paramSearch','type','xml','data'));

    }

    public function info($cropName,$sickNameKor){
        //요청변수들
        $serviceCode = "SVC05";
        $sickKey = $this->key_search($cropName,$sickNameKor); //sickKey 받아오는 메서드
        $param = "&serviceCode=".$serviceCode."&sickKey=".$sickKey;
        $array = $this->call_api($param);
        return view('info',['array'=>$array,'name'=>$cropName,'sick'=>$sickNameKor]);

    }

    /**
     * xml 호출
     *
     * @param String $param api 요청변수
     *
     * @return Property xml 배열
     */
    public function call_api(string $param)
    {
        $apiKey = env('apiKey');
        $ncpmUrl = env('ncpmUrl');
        $parameter = "apiKey=" . $apiKey.$param;
        $url = $ncpmUrl. $parameter;
        $test = Http::GET($url);
        $xml = simplexml_load_string($test);
        return $xml;
    }
    /**
     * sickKey search 질병 정보 api 호출 키 검색
     *
     * @param string $cropName 작물 명
     * @param string $sickNameKor 병 한글 명
     *
     * @return Property sickKey 값
     */
    public function key_search(string $cropName, string $sickNameKor)
    {
        $serviceCode = "SVC01";
        $serviceType = "AA001:XML";
        $param = "&serviceCode=".$serviceCode."&serviceType=".$serviceType."&cropName=".$cropName."&sickNameKor=".$sickNameKor;
        $xml = $this->call_api($param);
        $sickKey = $xml->list->item->sickKey;
        return $sickKey;
    }

    /**
     *
     * 컬렉션 페이지네이션
     *
     *
     * @param array|Collection $items 컬렉션 배열
     * @param int $perPage 페이지네이션 해줄 갯수
     * @param int $page 초기 페이지 Null
     * @param array $options 옵션
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

