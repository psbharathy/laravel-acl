
<div class="container">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}"><img class="homeLogo" src="{{URL::asset('assets/acl/images/logo.png')}}" width='112px'
         height="35px"></a>
     </div>
     <!-- Collect the nav links, forms, and other content for toggling -->
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav dropdownForMenu">
                        <a class="dropdown-toggle fake-link" data-toggle="dropdown">Operations
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/') }}"><i class="fa fa-table"></i>  Dashbaord</a></li>
                            <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/host') }}"><i class="fa fa-table"></i>  Host</a></li>
                             <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/bay') }}"><i class="fa fa-table"></i>  Bay</a></li>

                             <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/station') }}"><i class="fa fa-table"></i>  Station</a></li>

                             <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/baylocation') }}"><i class="fa fa-table"></i>  Bay Location</a></li>

                             <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/region') }}"><i class="fa fa-table"></i>  Region</a></li>

                            <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/branch') }}"><i class="fa fa-table"></i>  Branch</a></li>
                        </ul>
                        </li>
                        <li><a id="top-navbar-menu" href="#body" style="display: none;" class="sr-only">Scroll to navbar</a></li>
                    </ul>
         <ul class="nav navbar-nav dropdownForMenu">
                        <a class="dropdown-toggle fake-link" data-toggle="dropdown">Customers
                            <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                   <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/industry') }}"><i class="glyphicon glyphicon-user"></i> Industry </a></li>
                   <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/advertiser') }}"><i class="glyphicon glyphicon-user"></i> Advertiser </a></li>
                   <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/creative') }}"><i class="glyphicon glyphicon-user"></i> Creative </a></li>
                    </ul>
                     <li><a id="top-navbar-menu" href="#body" style="display: none;" class="sr-only">Scroll to navbar</a></li>
                    </ul>
        <ul class="nav navbar-nav ">
           <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/admin/users') }}"><i class="glyphicon glyphicon-user"></i> Users </a></li>
        </ul>

        <ul class="nav navbar-nav ">
           <li id="oss-dev-top-bar-lqp"><a href="{{ URL::to('/admin/roles') }}"><i class="glyphicon glyphicon-list-alt"></i> Roles </a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right ">
            @if (Auth::check())
            <li>
                <a href="#"><span class="userWelcome">Welcome</span> &nbsp <span class="userIcon">{{ Auth::user()->name }}</span></a>
            </li>
            @endif
            <li>
                <a href="{{ URL::to('/auth/logout') }}"><i class="glyphicon glyphicon-off"></i> Logout</a>
            </li>
        </ul>
    </div>
</div>
</div>
</div>

