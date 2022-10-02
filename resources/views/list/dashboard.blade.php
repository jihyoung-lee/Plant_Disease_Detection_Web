
@extends('layouts.master')


@section('title')
    <title>작물 진단 시스템</title>
@endsection

@section('content')
    <style>
        .table {
            --bs-table-hover-bg: #e7ffe7;
        }
    </style>
    <div class="container"style="padding-top:100px;">

        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
        @endif
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
        <header>
            <h1>AI 작물 진단</h1>
        </header>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            진단하기
        </button>
        <!-- Modal -->

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">작물 진단</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 모달 내용 -->

                        <div class="form-group">
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading"><i class="bi bi-exclamation-circle"></i>이미지를 업로드 해주세요</h4>
                                <p class="mb-0">총 33개의 결과를 제공합니다</p>
                                <hr>
                                <p class="mb-0">진단 가능 작물 : 사과, 옥수수, 포도, 복숭아, 후추, 토마토</p>
                                <p>감자, 딸기</p>

                            </div>
                            <label for="recipient-name" class="col-form-label"><i class="bi bi-images"></i>사진</label>
                            <form action="{{route('photo.store')}}" method="post" enctype="multipart/form-data" name="">
                                @csrf
                                <!-- 이미지만 첨부할 수 있도록 처리-->
                                <div>
                                    <input type="file" name="photo"class="form-control form-control-lg" id="formFileLg"  accept="image/*">
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                        <input type="submit" value="확인" class="btn btn-primary" data-bs-target="#ModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ModalToggle2" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalToggleLabel2">판별 중..</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center">
                            <strong>Loading...</strong>
                            <div class="spinner-border text-success ms-auto" role="status" aria-hidden="true"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- 테이블-->
        <table class="table table-hover">
            <thead>
            <tr >
                <th scope="col">사진</th>
                <th scope="col">작물</th>
                <th scope="col">병</th>
                <th scope="col">등록일</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <!-- 테스트 값-->

            @foreach ($Photos as $data)

                <!-- 상세화면 Modal -->
                <div class="modal fade" id="infomodal{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal2">진단결과</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- 모달 내용 -->
                                <div class = "modal-form">
                                    <img class="img-responsive" src="{{$data->url}}" alt="">
                                </div>
                                <div class="modal-form">
                                    <label for="recipient-name" class="col-form-label">작물 명</label>
                                </div>

                                <div class="col-sm-13">
                                    <input type="text" style = "text-align:center;" readonly class="form-control-plaintext" id="staticEmail" value="{{$data->cropName}}">
                                </div>

                                <div class = 'modal-form'>
                                    <label for="recipient-name" class="col-form-label">병 명</label>
                                </div>
                                <div class="col-sm-13">
                                    <input type="text"style = "text-align:center;"  readonly class="form-control-plaintext" id="staticEmail" value="{{$data->sickNameKor}}">
                                </div>

                                <div class="modal-form">
                                    <label for="recipient-name" class="col-form-label">예측 신뢰도</label>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{$data->confidence}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$data->confidence}}%">
                                            <span class="sr-only">{{$data->confidence}}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" value="의견보내기" class="btn btn-outline-info" data-bs-target="#opinion{{$data->id}}" data-bs-toggle="modal" data-bs-dismiss="modal">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="opinion{{$data->id}}" aria-hidden="true" aria-labelledby="ModalToggleLabel2" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalToggleLabel3">의견</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="/opinion/{{$data->id}}">
                                @csrf
                                <div class="modal-body">

                                    <div class="modal-form">
                                        <label for="recipient-name" class="col-form-label">작물</label>
                                    </div>

                                    <div class="col-sm-13">
                                        <input type="text" style = "text-align:center;" class="form-control-plaintext" name="cropName" value="{{$data->cropName}}">
                                    </div>


                                    <div class = 'modal-form'>
                                        <label for="recipient-name" class="col-form-label">병</label>
                                    </div>
                                    <div class="col-sm-13">
                                        <input type="text" style = "text-align:center;"class="form-control-plaintext" name="sickNameKor" value="{{$data->sickNameKor}}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-dismiss="modal">취소</button>
                                    <input type="submit" value="의견보내기" class="btn btn-outline-info" data-bs-target="#opinion{{$data->id}}">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <tr valign="middle">
                    <td><img src="{{$data->url}}" alt="" width="100" height="100"></td>
                    <td>{{$data->cropName}}</td>
                    {{$data->url}}

                    @if($data->sickNameKor == '정상')
                        <td>{{$data->sickNameKor}}</td>
                    @else
                        <td> <a style="color: green" rel="external" href="/info/{{$data->cropName}}/{{$data->sickNameKor}}">{{$data->sickNameKor}}</a>  </td>
                    @endif
                    <td>{{$data->created_at }} </td>

                    <td>
                        <button type="submit" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#infomodal{{$data->id}}" >상세정보</button>
                    </td>
                </tr>
            </tbody>
            @endforeach

        </table>
        {{ $Photos->links() }}
    </div>
@endsection
