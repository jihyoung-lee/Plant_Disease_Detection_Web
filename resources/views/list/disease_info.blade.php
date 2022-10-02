@extends('layouts.master')
@section('title')
<title>{{$array->sickNameKor}}</title>
@endsection


@section('content')
<style>.accordion-button:not(.collapsed) {
        color: #006638;
        background-color: rgba(217, 255, 244, 0.32);
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.125);
    }
</style>

<div class="container"style="padding-top:100px;">
    <header>
        <h1>상세정보</h1>
    </header>
    <table class="table table-bordered">
        @isset($array->imageList->item[0]->image)
        <thead>
        <td valign="middle" rowspan="5" class="success">피해사진<br></td>
        <td valign="middle" rowspan="5"><img src="{{$array->imageList->item[0]->image}}" alt=""width="300" height="300"></td>
        </thead>
        @endisset

        <tr>

            @if(!$array->sickNameKor)
            <td valign="middle" class="success">병·해충 명</td>
            <td valign="middle"  class="tg-c3ow">{{$sick}}</td>
        </tr>
        <tr>
            <td valign="middle" class="success">작물 명</td>
            <td valign="middle"  class="tg-c3ow">{{$name}}</td>
            @else
            <td valign="middle" class="success">병·해충 명</td>
            <td valign="middle"  class="tg-c3ow">{{$array->sickNameKor }}</td>
        </tr>
        @if(!empty($array->virusList->item->virusName))
        <tr>
            <td valign="middle" class="success">병원체 명</td>
            <td valign="middle" > {{$array->virusList->item->virusName}}</td>
        </tr>
        @else
        @endif
        <tr>
            <td valign="middle" class="success">작물 명</td>
            <td valign="middle" >{{$array->cropName}}</td>
        </tr>
        @if(!empty($array->sickNameChn))
        <tr>
            <td valign="middle" class="success" >한문 명</td>
            <td valign="middle" >{{$array->sickNameChn}}</td>
        </tr>
        @else
        @endif

        @if(!empty($array->sickNameEng))
        <tr>
            <td valign="middle" class="success" > 영문 명</td>
            <td valign="middle" >{{$array->sickNameEng}}</td>
        </tr>
        @else
        @endif

    </table>

    <div class="accordion accordion-flush" id="accordionFlushExample">
        @if(!empty($array->symptoms))

        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                    <h3>증상</h3>
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne">
                <div class="accordion-body">  {!! $array->symptoms !!}</div>
            </div>
        </div>
        @else
        @endif

        @if(!empty($array->virusList->item->sfeNm))
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                    <h3>특징</h3>
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo">
                <div class="accordion-body">{!! $array->virusList->item->sfeNm !!}</div>
            </div>
        </div>
        @else
        @endif

        @if(!empty($array->developmentCondition))
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="true" aria-controls="flush-collapseThree">
                    <h3>발생 생태</h3>
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" >
                <div class="accordion-body">   {!! $array->developmentCondition!!}</div>
            </div>
        </div>
        @else
        @endif

        @if(!empty($array->preventionMethod))
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="true" aria-controls="flush-collapseFour">
                    <h3>방제 방법</h3>
                </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour">
                <div class="accordion-body">    {!! $array->preventionMethod!!}</div>
            </div>
        </div>

    </div>
    @else
    @endif
    @endif
</div>
@endsection<?php
