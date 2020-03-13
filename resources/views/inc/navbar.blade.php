<header>
    <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: white; box-shadow: 0px 9px 25px -17px rgba(0,0,0,0.75);">
        <div class="container">
        <a class="navbar-brand" href="/" style="color: #3956A3; font-weight: bold;"><img src="/uploads/logo-blue.png" style="width: 120px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">


            @if(Auth::check())
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/section">Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">logout</a>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="/login" class="nav-link my-2 my-sm-0">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link my-2 my-sm-0">Register</a>
                    </li>
                </ul>


            @endif

            {{--<ul class="navbar-nav ml-auto">--}}
                {{--<li class="nav-item active">--}}
                    {{--<a class="nav-link" href="/">Home</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="/collection/create">Create Collection</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        </div>
        </div>
    </nav>



</header>