<!-- font -->
<!-- Goggle Font -->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--stylesheet-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('css/theme.css')}}">
<link rel="shortcut icon" type="image⁄x-icon" href="{{asset('img/favicon.ico')}}">
<style>
    body{
        background-image: url("{{asset('img/opportunities-bg.png')}}");
        background-size: cover;
    }
    #footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 0.5rem;            /* 푸터 높이 */
    }
    #page-container {
        position: relative;
        min-height: 30vh;
    }
    #content-wrap {
        padding-bottom: 1rem;    /* 푸터 높이 */
    }
    .progress-bar {
        background-color: #00ad07;
    }
    .modal-form {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        overflow: hidden;
        color: #008606;
        text-align: center;
        white-space: nowrap;
        background-color: #ffffff;
        -webkit-transition: width 0.6s ease;
        -o-transition: width 0.6s ease;
        transition: width 0.6s ease;
    }
</style>
