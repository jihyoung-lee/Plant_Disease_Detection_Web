<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class SearchController extends Controller
{
    /* Search Result */
    public function index(Request $request)
    {
        list($serviceCode, $serviceType, $displayCount, $paramSearch, $paramStr, $type) = $this->diseaseApiRequest($request);
        //작물
        if($request->input('type')==1){
            $paramSearch =  $request->input('search');
            $paramStr= "&cropName=";
            $type = 1;
        }
        //병
        elseif ($request->input('type')==2)
        {
            $paramSearch = $request->input('search');
            $paramStr =  "&sickNameKor=";
            $type = 2;
        }
            $envVarName = 'apiKey';
            $param = "&serviceCode=".$serviceCode."&serviceType=".$serviceType.$paramStr.$paramSearch."&displayCount=".$displayCount;
            $xml = $this->callApi($param,$envVarName);

            if($xml->totalCount > 1){
                $array = $xml->list;
                $json = json_decode( json_encode( $array ), 1 );
                $data = $json['item'] ;
           }
            # 검색결과가 1개인 경우 json 배열이 다르므로 따로 처리
            elseif($xml->totalCount=1){
                $array = $xml->list->item;
                $data = json_decode( json_encode( $array ), 1 );
            }
            # xml 배열이 비어있으면 빈 배열을 변수에 넣음
            elseif($xml->totalCount=0) {
                $data = [];
            }

        # 페이지네이션
        $CollectionObj = collect($data);
        $array = $this->paginate($CollectionObj);
        $array->withPath('/list/?search='.$paramSearch);

        return view('list/disease_list',compact('array','paramSearch','type','xml','data'));
        }

    /* 상세정보 화면 */
    public function infoIndex($cropName, $sickNameKor){
        $array = $this->info($cropName,$sickNameKor);
        return view('list/info',['array'=>$array,'name'=>$cropName,'sick'=>$sickNameKor]);
    }

    /* Info API Request */
    public function info($cropName,$sickNameKor){
     //요청변수들
     $serviceCode = "SVC05";
     $sickKey = $this->apiKeySearch($cropName,$sickNameKor); //sickKey 받아오는 메서드
     $param = "&serviceCode=".$serviceCode."&sickKey=".$sickKey;
     $array = $this->callApi($param);

     return $array;
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
        $items = $items ? $items : Collection::make($items); # $items 배열을 컬렉션배열로 만들어줍니다
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * xml 호출
     *
     * @param String $param api 요청변수
     *
     * @return Property xml 배열
     */
    public function callApi(string $param, $envVarApiName)
    {
        $apiKey = env($envVarApiName);
        $parameter = "apiKey=" . $apiKey.$param;
        $url = "http://ncpms.rda.go.kr/npmsAPI/service?" . $parameter;
        $test = Http::GET($url);
        $xml = simplexml_load_string($test);

        return $xml;
    }
    /**
     * sickKey search
     *
     * @param string $cropName 작물 명
     * @param string $sickNameKor 병 한글 명
     *
     * @return Property sickKey 값
     */
    public function apiKeySearch(string $cropName, string $sickNameKor): Property
    {
        $serviceCode = "SVC01";
        $serviceType = "AA001:XML";
        $param = "&serviceCode=".$serviceCode."&serviceType=".$serviceType."&cropName=".$cropName."&sickNameKor=".$sickNameKor;
        $xml = $this->callApi($param);
        $sickKey = $xml->list->item->sickKey;

        return $sickKey;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function diseaseApiRequest(Request $request): array
    {
//요청변수들
        $serviceCode = "SVC01";
        $serviceType = "AA001:XML";
        $displayCount = 50;
        //검색 디폴트 값
        $paramSearch = $request->input('search', '사과');
        $paramStr = "&cropName=";
        $type = 1;
        return array($serviceCode, $serviceType, $displayCount, $paramSearch, $paramStr, $type);
    }


}
