<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <title>@yield('title')</title>
        <style></style>
   

        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="icon" type="image/x-icon" href="{{asset('uploads/cart.jpg')}}">

  
    @yield('style')
</head>
<body>
    @yield('content')
    @yield('script')
</body>
</html>
