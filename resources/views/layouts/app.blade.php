<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Romario Giacholari">
    <meta name="description" content="Personal website of Romario Giacholari. Web Developer and Student in Birmingham, UK.">
    <meta name="keywords" content="HTML,CSS,JavaScript,PHP,Laravel,Vue.js,Romario Giacholari">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Romario Giacholari | @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
</head>
<body class="opacity-is-loading">
    <div id="app">
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('welcome') }}">home</a></li>
                        <li class="{{ Request::is('posts*') ? 'active' : '' }}"><a href="{{ route('posts.index') }}">blog</a></li>
                        <li class="{{ Request::is('all-photos*') ? 'active' : '' }}"><a href="{{ route('photos') }}">photos</a></li>
                        <li class="{{ Request::is('resume') ? 'active' : '' }}"><a href="{{ route('resume') }}">resume</a></li>
                        <li class="{{ Request::is('podcast*') ? 'active' : '' }}"><a href="{{ route('episodes.index') }}">podcast</a></li>
                        <li class="{{ Request::is('coffee*') ? 'active' : '' }}"><a href="{{ route('coffee.index') }}">coffee</a></li>
                        <li class="{{ Request::is('contact*') ? 'active' : '' }}"><a href="{{ route('contact.create') }}">contact</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @auth
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="/home/posts">posts</a></li>
                                    <li><a href="/home/episodes">episodes</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        <div style="padding:25px; margin-top:100px">
            <div id="contact-links" class="text-center">
                <a href = 'https://github.com/RomarioGiacholari' target="_blank"><i class="fab fa-github" aria-hidden="true"></i></a>
                <a href = 'https://twitter.com/giacholari' target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                <a href = 'https://www.instagram.com/am.giacholari/' target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                <a href = 'https://www.linkedin.com/in/romario-giacholari-71130b11b?trk=hp-identity-name' target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
            </div>
            <div class="text-center">
                <p>Fine print: <a href="{{ route('privacy-policy.index') }}">privacy</a></p>
            </div>
            <div class="text-center">
                <p>&copy;2020 Giacholari.</p>
                <p id="dateElement"></p>
            </div>
        </div>
        <span class="centered"><i class="fas fa-circle-notch fa-spin fa-2x"></i></span>
    </div>
     <script type="text/javascript" defer>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-90120268-3', 'auto');
        ga('send', 'pageview');
    </script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/spinner.js') }}" type="text/javascript"></script>
    @yield('scripts')
</body>
</html>
