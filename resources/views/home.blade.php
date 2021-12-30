@extends('layouts.master')
@section('title')
    <title>AI 병해 진단 시스템</title>
@endsection
@section('nav')
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 bg-light opacity-85" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="/"><img class="d-inline-block align-top img-fluid" src="img/planting.svg" alt="" width="50" /><span class="text-theme font-monospace fs-4 ps-2"></span></a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page" href="#header">Home</a></li>
                    <li class="nav-item px-2"><a class="nav-link fw-medium" href="#predict">info</a></li>
                    <li class="nav-item px-2"><a class="nav-link fw-medium" href="#howtouse">How to use</a></li>
                </ul>
                <button class="btn btn-lg btn-dark bg-gradient order-0" onclick="location.href='{{route('photo.index')}}'">AI 시스템</button>

            </div>
        </div>
    </nav>
@endsection
@section('content')
    <!--/.bg-holder-->
    <section class="py-0" id="header">
        <div class="bg-holder d-none d-md-block" style="background-image:url({{asset('img/hero-bg.png')}});background-position:right top;background-size:contain;">
        </div>
        <div class="bg-holder d-md-none" style="background-image:url({{asset('img/hero-bg.png')}});background-position:right top;background-size:contain;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row align-items-center min-vh-75 min-vh-lg-100">
                <div class="col-md-7 col-lg-6 col-xxl-5 py-6 text-sm-start text-center">
                    <h1 class="mt-6 mb-sm-4 fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">AI 인공지능  <br class="d-block d-lg-block" />작물 병해 진단 시스템</h1>
                    <p class="mb-4 fs-1">PC와 모바일 환경 모두 간편하게 이용하는  <br class="d-block d-lg-block" /> 딥러닝을 이용한 병해 진단 AI 사이트 </p><a class="btn btn-lg btn-success" href="#howtouse" role="button"0>How To Use</a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5" id="predict">
        <div class="bg-holder d-none d-sm-block" style="background-image:url({{asset('img/bg.png')}});background-position:top left;background-size:225px 755px;margin-top:-17.5rem;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto text-center mb-3">
                    <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">작물의 병해 진단 시스템</h5>
                    <p class="mb-5">딥러닝 기술을 이용한 인공지능 병해 진단 시스템입니다. 총 38개의 결과를 제공합니다</p>
                </div>
            </div>
            <div class="row flex-center h-100">
                <div class="col-xl-9">
                    <div class="row">
                        <div class="col-md-4 mb-5">
                            <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-6">
                                <div class="text-center text-md-start card-hover"><img class="ps-3 icons" src="{{asset('img/clipboard-data.svg')}}" height="60" alt="" />
                                    <div class="card-body">
                                        <h6 class="fw-bold fs-1 heading-color">쉽고 간편한 자가 진단</h6>
                                        <p class="mt-3 mb-md-0 mb-lg-2">사진 한장으로 간편하게 작물의 병해를 자가 진단해 볼 수 있어 빠른 방제가 가능합니다</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-6">
                                <div class="text-center text-md-start card-hover"><img class="ps-3 icons" src="{{asset('img/phone-vibrate.svg')}}" height="60" alt="" />
                                    <div class="card-body">
                                        <h6 class="fw-bold fs-1 heading-color">PC와 모바일 환경 모두 지원</h6>
                                        <p class="mt-3 mb-md-0 mb-lg-2">컴퓨터와 스마트폰 기기 종류와 상관없이 어디서든 간편하게 이용해볼 수 있습니다</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="card h-100 shadow px-4 px-md-2 px-lg-3 card-span pt-6">
                                <div class="text-center text-md-start card-hover"><img class="ps-3 icons" src="{{asset('img/journal-richtext.svg')}}" height="60" alt="" />
                                    <div class="card-body">
                                        <h6 class="fw-bold fs-1 heading-color">병해충 도감과의 연동</h6>
                                        <p class="mt-3 mb-md-0 mb-lg-2">농촌진흥청에서 제공하는 다양한 방제 정보를 얻어볼 수 있습니다</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-5" id="invest">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 mb-3">
                    <div class="row">
                        <div class="col-lg-9 mb-3">
                            <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">딥러닝을 이용한 AI 작물 진단</h5>
                            <p class="mb-5">인공지능으로 간편하게 진단하고 관련 정보를 쉽게 알아 볼 수 있습니다</p>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="card text-white"><img class="card-img" src="{{asset('img/leaf.jpg')}}" alt="..." />
                                <div class="card-img-overlay d-flex flex-column justify-content-center px-5 px-md-3 px-lg-5 bg-dark-gradient">
                                    <h3 class="text-success pt-2"><i class="bi bi-bug"></i></h3>
                                    <hr class="text-white" style="height:0.12rem;width:2.813rem" />
                                    <div class="pt-lg-3">
                                        <h6 class="fw-bold text-white fs-1 fs-md-2 fs-lg-3 w-xxl-50">작물 진단</h6>
                                        <p class="w-xxl-75">딥러닝 기술을 이용한 작물 진단 서비스</p>
                                        <button class="btn btn-lg btn-light text-success" type="button" onclick="location.href='{{route('photo.index')}}'">Learn More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="card text-white"><img class="card-img" src="{{asset('img/fruit.jpg')}}" alt="..." />
                                <div class="card-img-overlay d-flex flex-column justify-content-center px-5 px-md-3 px-lg-5 bg-light-gradient">
                                    <h3 class="text-success pt-2"><i class="bi bi-book"></i></h3>
                                    <hr class="text-white" style="height:0.12rem;width:2.813rem" />
                                    <div class="pt-lg-3">
                                        <h6 class="fw-bold text-white fs-1 fs-md-2 fs-lg-3 w-xxl-50">병해충 정보</h6>
                                        <p class="w-xxl-75">농촌 진흥청에서 제공하는<br> 다양한 병해충 정보</p>
                                        <button class="btn btn-lg btn-light text-success" type="button" onclick="location.href='{{route('search.index')}}'">Learn More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

    <section class="py-0" id="howtouse">
        <div class="bg-holder" style="background-image:url({{asset('img/how-it-works.png')}});background-position:center bottom;background-size:cover;">
        </div>
        <!--/.bg-holder-->

        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-9 col-xl-5 text-center pt-8">
                    <h5 class="fw-bold fs-3 fs-xxl-5 lh-sm mb-3 text-white">사용 방법</h5>
                    <p class="mb-5 text-white">안내사항을 읽고 단계별로 따라해주세요</p>
                    <button class="btn btn-lg btn-light text-success" type="button" onclick="location.href='{{route('photo.index')}}'">AI 진단하러 가기</button>
                </div>
                <div class="col-sm-9 col-md-12 col-xxl-9">
                    <div class="theme-tab">
                        <ul class="nav justify-content-between">
                            <li class="nav-item" role="presentation"><a class="nav-link active fw-semi-bold" href="#bootstrap-tab1" data-bs-toggle="tab" data-bs-target="#tab1" id="tab-1"><span class="nav-item-circle-parent"><span class="nav-item-circle">01</span></span></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link fw-semi-bold" href="#bootstrap-tab2" data-bs-toggle="tab" data-bs-target="#tab2" id="tab-2"><span class="nav-item-circle-parent"><span class="nav-item-circle">02</span></span></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link fw-semi-bold" href="#bootstrap-tab3" data-bs-toggle="tab" data-bs-target="#tab3" id="tab-3"><span class="nav-item-circle-parent"><span class="nav-item-circle">03</span></span></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link fw-semi-bold" href="#bootstrap-tab4" data-bs-toggle="tab" data-bs-target="#tab4" id="tab-4"><span class="nav-item-circle-parent"><span class="nav-item-circle">04</span></span></a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab-1">
                                <div class="row align-items-center my-6 mx-auto">
                                    <div class="col-md-6 col-lg-5 offset-md-1">
                                        <h3 class="fw-bold lh-base text-white">AI 진단을 진행할 <br> 작물 잎 이미지를 준비해주세요</h3>
                                    </div>
                                    <div class="col-md-5 text-white offset-lg-1">
                                        <p class="mb-0">이미지 용량이 너무 크면 작게 조절해주세요</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab-2">
                                <div class="row align-items-center my-6 mx-auto">
                                    <div class="col-md-6 col-lg-5 offset-md-1">
                                        <h3 class="fw-bold lh-base text-white">작물 진단 버튼을 클릭하고<br> 준비한 이미지를 업로드 해주세요</h3>
                                    </div>
                                    <div class="col-md-5 text-white offset-lg-1">
                                        <p class="mb-0">사진을 첨부하지 않으면 경고메세지가 뜹니다</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab-3">
                                <div class="row align-items-center my-6 mx-auto">
                                    <div class="col-md-6 col-lg-5 offset-md-1">
                                        <h3 class="fw-bold lh-base text-white">잠시 기다리면<br> AI 진단 결과가 나옵니다</h3>
                                    </div>
                                    <div class="col-md-5 text-white offset-lg-1">
                                        <p class="mb-0">서버와의 연결이 끊어졌다는 <br>경고메세지가 나온다면 나중에 다시 시도해주세요</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab-4">
                                <div class="row align-items-center my-6 mx-auto">
                                    <div class="col-md-6 col-lg-5 offset-md-1">
                                        <h3 class="fw-bold lh-base text-white">결과를 확인하고 <br>링크를 클릭합니다 </h3>
                                    </div>
                                    <div class="col-md-5 text-white offset-lg-1">
                                        <p class="mb-0">농촌 진흥청에서 제공한<br>병해와 관련된 정보들을 확인할 수 있습니다</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
