<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href= https://cdn.jsdelivr.net/npm/bootswatch@5.0.1/package.json">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- title 값을 주지 않았을 때 기본값으로 넣어주는 것-->
    <title>@yield('title','기본값')</title>
</head>
<body>
<div>
    @yield('content')
</div>
</body>
</html>
