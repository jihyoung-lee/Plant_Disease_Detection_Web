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
    public function index(Request $request)
    {
        $searchType = $request->input('type');
        $paramSearch = $request->input('search', '사과');
        $paramStr = $searchType == 1 ? "&cropName=" : "&sickNameKor=";
        $xml = $this->callApi([
            'apiKey' => config('services.rda.api_key'),
            'param' => "&serviceCode=SVC01&serviceType=AA001:XML".$paramStr.$paramSearch."&displayCount=50",
        ]);

        $data = [];
        if ($xml->totalCount > 0) {
            $data = json_decode(json_encode($xml->list->item), true);
            if (!is_array($data)) {
                $data = [$data];
            }
        }

        $array = $this->paginate($data);
        $array->withPath('/list/?search='.$paramSearch);

        return view('list.disease_list', compact('array', 'paramSearch', 'searchType', 'xml', 'data'));
    }

    public function infoIndex($cropName, $sickNameKor)
    {
        $array = $this->info($cropName, $sickNameKor);
        return view('list/info', ['array' => $array, 'name' => $cropName, 'sick' => $sickNameKor]);
    }

    public function info($cropName, $sickNameKor)
    {
        $apiKey = config('services.rda.api_key');
        $sickKey = $this->getSickKey($apiKey, $cropName, $sickNameKor);
        $xml = $this->callApi([
            'apiKey' => $apiKey,
            'param' => "&serviceCode=SVC05&sickKey=".$sickKey,
        ]);

        return $xml;
    }

    protected function getSickKey($apiKey, $cropName, $sickNameKor)
    {
        $xml = $this->callApi([
            'apiKey' => $apiKey,
            'param' => "&serviceCode=SVC01&serviceType=AA001:XML&cropName={$cropName}&sickNameKor={$sickNameKor}",
        ]);

        return (string) $xml->list->item->sickKey;
    }

    protected function callApi($options)
    {
        $apiKey = $options['apiKey'];
        $param = $options['param'];
        $url = "http://ncpms.rda.go.kr/npmsAPI/service?apiKey={$apiKey}{$param}";
        $xml = simplexml_load_string(Http::get($url));

        return $xml;
    }

    protected function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items ? $items : [];
        $collection = collect($items);
        return new LengthAwarePaginator($collection->forPage($page, $perPage), $collection->count(), $perPage, $page, $options);
    }
}
