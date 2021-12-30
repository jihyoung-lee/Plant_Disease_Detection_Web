<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.header_css')
    @yield('title','작물 병해 진단 시스템')
</head>
<body>
@yield('nav',View::make('layouts.navbar'))
@yield('content')
@include('layouts.footer')
</body>
@include('layouts.footer_js')
@yield('script')
</html>
