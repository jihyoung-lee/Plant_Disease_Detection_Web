
@extends('layouts.master')


@section('title')
    <title>관리 페이지</title>
@endsection
@section('nav')
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 bg-light opacity-85" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="/"><img class="d-inline-block align-top img-fluid" src="img/planting.svg" alt="" width="50" /><span class="text-theme font-monospace fs-4 ps-2"></span></a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page" href="/">Home</a></li>
                    <li class="nav-item px-2"><a class="nav-link fw-medium" href="{{route('admin.index')}}">학습데이터 관리</a></li>
                </ul>
                <button type="button" onclick="location.href='{{route('login.logout')}}'"  class="btn btn-outline-danger">로그아웃</button>
            </div>
        </div>
    </nav>
@endsection
@section('content')

    <div class="container"style="padding-top:100px;">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
        @endif

        <table class="table table-hover">
            <thead>
            <tr >
                <th scope="col">사진</th>
                <th scope="col">예측 결과</th>
                <th scope="col">사용자 의견</th>
                <th scope="col">등록일</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($train ?? '' as $data)

                <tr valign="middle">
                    <td><img src="{{$data->url}}" alt="" width="100" height="100"></td>
                    <td>{{$data->cropName}}_{{$data->sickNameKor}}</td>
                    <td>{{$data->userOpinion}}</td>
                    <td>{{$data->created_at }} </td>


                    @if($data->userOpinion=='없음' or $data->userOpinion == $data->cropName.'_'.$data->sickNameKor or $data->modify == 1 )
                        <td>

                        </td>
                    @else
                        <td>
                            <form method="POST" action="{{route('admin.update',['id'=>$data->id])}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-info">수정</button>
                            </form>
                        </td>
                    @endif
                    <td>
                        <form method="POST" action="{{route('admin.delete',[$id=>$data->id])}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">삭제</button>
                        </form>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        {{ $train->links() }}
    </div>
@endsection<?php
