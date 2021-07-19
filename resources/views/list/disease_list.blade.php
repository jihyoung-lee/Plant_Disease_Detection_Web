
@extends('layouts.master')


@section('title')
    <title>병해충 도감</title>
@endsection

@section('content')
    <style>
        .table{
            --bs-table-hover-bg: #a5dcc387;
        }
    </style>
    <br>
    <div class="container">

        <header>
            <h1>병해충 도감</h1>
        </header>
        <article id="board_area">
            <form action="/test/" method="POST">
                @csrf
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="Search for..." name="search" required value="{{$paramSearch}}">
                    <span class="input-group-btn">
            <button class="btn btn-success btn-lg"><i class="bi bi-search"></i>검색</button></span>
                </div>
                <input type="radio" name="type" value="1" @if($type == 1) checked="checked"@endif>작물
                <input type="radio" name="type" value="2"@if($type ==2) checked="checked" @endif>병
            </form>

            @if(isset($array))
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">사진</th>
                        <th scope="col">작물</th>
                        <th scope="col">병</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($array as $arrays)


                        <tr>
                            <td valign="middle"><img src="
            @if(($arrays['oriImg']==[]))
                                @else{{$arrays['oriImg']}}
                                @endif" alt=""width="100" height="100"></td>
                            <td valign="middle" >{{ $arrays['cropName']}}</td>
                            @if($arrays['sickKey']==[])
                                <td>{{$arrays['sickNameKor']}}</td>
                            @else
                                <td valign="middle" ><a style="text-decoration: none; color: green" rel="external" href="/info/{{$arrays['cropName']}}/{{$arrays['sickNameKor']}}">{{$arrays['sickNameKor']}}</a></td>
                            @endif
                            @endforeach
                        </tr>

                    </tbody>



                </table>

                <p>{{ $array->appends(array_filter(Request::only('type')))->links() }}</p>

        </article>
        @endif
    </div>
@endsection
