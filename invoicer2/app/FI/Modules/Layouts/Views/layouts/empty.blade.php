<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ Config::get('fi.headerTitleText') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ $protocol }}://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,300italic,400italic,600italic" rel="stylesheet" type="text/css">

    @yield('head')

</head>
<body class="skin-blue fixed">

    <header class="header">
        <a href="#" class="logo">{{ Config::get('fi.headerTitleText') }}</a>

        <nav class="navbar navbar-static-top" role="navigation">

        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">

        <aside class="left-side sidebar-offcanvas">                

            <section class="sidebar">

                @yield('sidebar')

            </section>

        </aside>

        @yield('content')

    </div>

    <div id="modal-placeholder"></div>

    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/FI/global.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/FI/app.js') }}" type="text/javascript"></script>

    @yield('jscript')

</body>
</html>