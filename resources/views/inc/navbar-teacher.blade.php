<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #3956A3;">
        <a class="navbar-brand" href="/"><img src="/uploads/logo-w.png" style="width: 100px;"></a>
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
    </nav>



</header>