<!DOCTYPE html>
    <head>
        <title>Laravel ACL Pack ::@yield('title')</title>

        <link rel="icon" href="/assets/crud-app/css/uibootstrap/images/favicon.ico" />

        @yield('css')

        <link rel="stylesheet" type="text/css"  href="/assets/acl/css/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css"  href="/assets/acl/lib/bootstrap-v3.2.0/css/bootstrap-theme.css"/>
        <link rel="stylesheet" type="text/css"  href="/assets/acl/lib/bootstrap-v3.2.0/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css"  href="/assets/acl/css/uibootstrap/jquery-ui-1.10.0.bootstrap.css" />
        <link rel="stylesheet" type="text/css"  href="/assets/acl/css/font-awesome.css" />
        <link rel="stylesheet" type="text/css"  href="/assets/acl/css/app.css" />

	    <script type="text/javascript" src="/assets/acl/js/jquery.min.js"></script>
	    <script type="text/javascript" src="/assets/acl/lib/bootstrap-v3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/assets/acl/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/assets/acl/js/bootbox.min.js"></script>
    </head>
    <body>
        @yield('menu')

        <div class='grid_holder'>
            @include('layouts.notifications')
            @yield('content')
	    </div>
    </body>
</html>
