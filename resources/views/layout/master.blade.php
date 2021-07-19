<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.header_css')
    <title>@yield('title','병해충 판별 시스템')</title>
</head>
<body>
@include('layouts/navbar')
@yield('content')
@include('layouts.footer')
</body>
</html>
