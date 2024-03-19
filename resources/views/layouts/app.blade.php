<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @include('layouts.headerLink')
    @yield('style')
</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>

    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('layouts.header')

        <div class="page-body-wrapper">

            @include('layouts.slidebar')

            <div class="page-body ">
                @yield('content')
            </div>

            @include('layouts.footer')
        </div>

    </div>

    @yield('script')
    @include('layouts.footerLink')
</body>
</html>
