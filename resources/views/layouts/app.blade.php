<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!--  Favicons  -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="/images/favicons/manifest.json">
    <link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" color="#482980">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 328.8 46.5" style="enable-background:new 0 0 328.8 46.5;" xml:space="preserve">
                        <g>
                            <path class="st0" d="M55.1,16.5l-4,18.9h-6.3l4-18.9h-5.2l1.1-5.3h16.6l-1.1,5.3H55.1z"/>
                            <path class="st0" d="M68.5,20.5h9.1l2-9.3h6.3l-5.1,24.2h-6.3l2.1-10h-9.1l-2.1,10H59l5.1-24.2h6.3L68.5,20.5z"/>
                            <path class="st0" d="M95.6,35.4l9.3-24.2h6.2l2.1,12.9l7.6-12.9h6.2l-1,24.2h-6.3l0.9-13.9l-8.7,13.9h-2.5l-2.5-13.9l-5,13.9H95.6z
                                "/>
                            <path class="st0" d="M145.7,31.2h-9l-2.3,4.2h-6.7L142,11.1h6.9l4.1,24.2h-6.7L145.7,31.2z M145,26.4l-1.1-8.1l-4.5,8.1H145z"/>
                            <path class="st0" d="M155.7,35.4l5.1-24.2h6.3l8.5,14.8l3.1-14.8h6.3l-5.1,24.2h-6.3l-8.5-14.8L162,35.4H155.7z"/>
                            <path class="st0" d="M213,17.3c-0.6-0.6-1.2-1-1.8-1.2c-0.6-0.3-1.3-0.4-1.9-0.4c-0.8,0-1.5,0.2-2.1,0.6c-0.6,0.4-1,0.9-1.1,1.5
                                c-0.1,0.4,0,0.8,0.2,1.1c0.2,0.3,0.5,0.5,0.9,0.7c0.4,0.2,0.8,0.4,1.3,0.5c0.5,0.1,1,0.3,1.5,0.5c1.9,0.7,3.2,1.6,3.9,2.7
                                c0.7,1.1,0.9,2.6,0.5,4.5c-0.3,1.2-0.7,2.4-1.3,3.4c-0.6,1-1.4,1.9-2.4,2.6c-1,0.7-2.1,1.3-3.3,1.7c-1.3,0.4-2.6,0.6-4.1,0.6
                                c-3.1,0-5.7-0.9-7.9-2.7l3.8-5.1c0.8,0.8,1.6,1.5,2.4,1.9c0.8,0.4,1.7,0.6,2.6,0.6c1,0,1.8-0.2,2.4-0.7c0.6-0.5,1-1,1.1-1.6
                                c0.1-0.4,0.1-0.7,0-0.9c-0.1-0.3-0.2-0.5-0.5-0.7s-0.6-0.4-1-0.6c-0.4-0.2-1-0.4-1.6-0.6c-0.8-0.3-1.5-0.5-2.2-0.9
                                c-0.7-0.3-1.3-0.7-1.8-1.2c-0.5-0.5-0.9-1.2-1.1-1.9c-0.2-0.8-0.2-1.8,0.1-3c0.3-1.2,0.7-2.3,1.3-3.3c0.6-1,1.3-1.8,2.2-2.5
                                s1.9-1.2,3-1.6c1.1-0.4,2.3-0.6,3.6-0.6c1.2,0,2.4,0.2,3.7,0.5s2.4,0.8,3.4,1.5L213,17.3z"/>
                            <path class="st0" d="M222.9,35.4h-6.3l5.1-24.2h10c2.7,0,4.7,0.7,5.8,2.1c1.1,1.4,1.4,3.4,0.9,6c-0.5,2.6-1.7,4.6-3.4,6
                                c-1.7,1.4-4,2.1-6.7,2.1h-3.7L222.9,35.4z M225.7,22.3h2.1c2.3,0,3.7-1,4.1-3c0.4-2-0.5-3-2.8-3H227L225.7,22.3z"/>
                            <path class="st0" d="M239.9,23.3c0.4-1.8,1.1-3.5,2.1-5c1-1.6,2.2-2.9,3.6-4.1c1.4-1.2,3-2.1,4.8-2.7s3.6-1,5.6-1
                                c1.9,0,3.7,0.3,5.2,1s2.7,1.6,3.7,2.7c0.9,1.2,1.6,2.5,1.9,4.1c0.3,1.6,0.3,3.2-0.1,5c-0.4,1.8-1.1,3.5-2.1,5
                                c-1,1.6-2.2,2.9-3.6,4.1c-1.4,1.2-3,2.1-4.8,2.7c-1.8,0.7-3.7,1-5.6,1c-2,0-3.7-0.3-5.2-1c-1.5-0.7-2.7-1.6-3.6-2.7
                                c-0.9-1.2-1.6-2.5-1.9-4.1C239.5,26.7,239.5,25,239.9,23.3z M246.5,23.3c-0.2,1-0.2,1.9,0,2.7c0.2,0.8,0.5,1.5,1,2.1
                                c0.5,0.6,1.1,1.1,1.9,1.4c0.8,0.3,1.6,0.5,2.5,0.5c0.9,0,1.8-0.2,2.7-0.5c0.9-0.3,1.7-0.8,2.5-1.4c0.8-0.6,1.4-1.3,1.9-2.1
                                c0.5-0.8,0.9-1.7,1.1-2.7s0.2-1.9,0-2.7c-0.2-0.8-0.5-1.5-1-2.1c-0.5-0.6-1.1-1.1-1.9-1.4c-0.8-0.3-1.6-0.5-2.5-0.5
                                c-0.9,0-1.8,0.2-2.7,0.5c-0.9,0.3-1.7,0.8-2.5,1.4c-0.7,0.6-1.4,1.3-1.9,2.1C247.1,21.4,246.7,22.3,246.5,23.3z"/>
                            <path class="st0" d="M288.3,35.4h-7.8l-4-9.3l-2,9.3h-6.3l5.1-24.2h9.8c1.3,0,2.5,0.2,3.4,0.6c0.9,0.4,1.6,0.9,2.1,1.6
                                c0.5,0.7,0.8,1.5,1,2.4s0.1,1.9-0.1,2.9c-0.4,1.8-1.2,3.3-2.3,4.5c-1.1,1.1-2.6,1.9-4.4,2.3L288.3,35.4z M277.3,22h1.2
                                c1.2,0,2.2-0.3,3-0.8c0.8-0.5,1.3-1.3,1.5-2.2c0.2-1,0-1.7-0.5-2.2c-0.6-0.5-1.5-0.8-2.7-0.8h-1.2L277.3,22z"/>
                            <path class="st0" d="M304.1,16.5l-4,18.9h-6.3l4-18.9h-5.2l1.1-5.3h16.6l-1.1,5.3H304.1z"/>
                            <path class="st0" d="M325.2,17.3c-0.6-0.6-1.2-1-1.8-1.2c-0.6-0.3-1.3-0.4-1.9-0.4c-0.8,0-1.5,0.2-2.1,0.6c-0.6,0.4-1,0.9-1.1,1.5
                                c-0.1,0.4,0,0.8,0.2,1.1c0.2,0.3,0.5,0.5,0.9,0.7c0.4,0.2,0.8,0.4,1.3,0.5c0.5,0.1,1,0.3,1.5,0.5c1.9,0.7,3.2,1.6,3.9,2.7
                                c0.7,1.1,0.9,2.6,0.5,4.5c-0.3,1.2-0.7,2.4-1.3,3.4c-0.6,1-1.4,1.9-2.4,2.6c-1,0.7-2.1,1.3-3.3,1.7c-1.3,0.4-2.6,0.6-4.1,0.6
                                c-3.1,0-5.7-0.9-7.9-2.7l3.8-5.1c0.8,0.8,1.6,1.5,2.4,1.9c0.8,0.4,1.7,0.6,2.6,0.6c1,0,1.8-0.2,2.4-0.7c0.6-0.5,1-1,1.1-1.6
                                c0.1-0.4,0.1-0.7,0-0.9c-0.1-0.3-0.2-0.5-0.5-0.7s-0.6-0.4-1-0.6c-0.4-0.2-1-0.4-1.6-0.6c-0.8-0.3-1.5-0.5-2.2-0.9
                                c-0.7-0.3-1.3-0.7-1.8-1.2c-0.5-0.5-0.9-1.2-1.1-1.9c-0.2-0.8-0.2-1.8,0.1-3c0.3-1.2,0.7-2.3,1.3-3.3c0.6-1,1.3-1.8,2.2-2.5
                                c0.9-0.7,1.9-1.2,3-1.6c1.1-0.4,2.3-0.6,3.6-0.6c1.2,0,2.4,0.2,3.7,0.5s2.4,0.8,3.4,1.5L325.2,17.3z"/>
                            <path class="st0" d="M37.8,0l-16,14.8h0.2c1.3-0.7,2.3-1.1,3-1.2c0.7-0.1,1.4-0.2,2-0.2c2.2,0,4.1,0.4,5.8,1.3c1.7,0.8,3,2,4.1,3.4
                                c1,1.5,1.7,3.2,2.1,5.1c0.3,2,0.3,4.1-0.2,6.3c-0.5,2.4-1.4,4.6-2.7,6.7c-1.3,2.1-3,3.9-5,5.4c-2,1.5-4.3,2.8-6.8,3.6
                                c-2.5,0.9-5.3,1.3-8.3,1.3c-3,0-5.6-0.4-7.8-1.3c-2.2-0.9-3.9-2.1-5.3-3.6c-1.3-1.5-2.2-3.3-2.7-5.3c-0.5-2-0.4-4.2,0.1-6.5
                                c0.5-2.6,1.7-5.3,3.5-8.3c1.8-3,4.1-5.9,7.1-8.8L24.2,0H37.8z M12,29.7c-0.2,1-0.2,2,0,2.9c0.2,0.9,0.6,1.7,1.1,2.4
                                c0.5,0.7,1.2,1.2,2,1.6c0.8,0.4,1.7,0.6,2.8,0.6c1,0,2.1-0.2,3-0.6c1-0.4,1.9-0.9,2.7-1.6c0.8-0.7,1.5-1.5,2.1-2.4
                                c0.6-0.9,1-1.9,1.2-2.9c0.2-1,0.2-2,0-2.9c-0.2-0.9-0.6-1.7-1.1-2.4c-0.5-0.7-1.2-1.2-2-1.6c-0.8-0.4-1.7-0.6-2.8-0.6
                                c-1,0-2.1,0.2-3,0.6c-1,0.4-1.9,0.9-2.7,1.6c-0.8,0.7-1.5,1.5-2.1,2.4C12.7,27.7,12.3,28.7,12,29.7z"/>
                        </g>
                        </svg>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::user())
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Years <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/years">View All</a></li>
                            <li><a href="/years/create">Create</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Game Times <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/times">View All</a></li>
                            <li><a href="/times/create">Create</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Teams <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/teams">View All</a></li>
                            <li><a href="/teams/create">Create</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Current Year <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/current-year">View Year</a></li>
                            <li><a href="/current-year/edit">Edit</a></li>
                          </ul>
                        </li>
                        @endif
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sports <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="/baseball">Baseball</a></li>
                            <li><a href="/basketball-boys">Basketball (boys)</a></li>
                            <li><a href="/basketball-girls">Basketball (girls)</a></li>
                            <li><a href="/bowling-boys">Bowling (boys)</a></li>
                            <li><a href="/bowling-girls">Bowling (girls)</a></li>
                            <li><a href="/cross-country">Cross Country</a></li>
                            <li><a href="/football">Football</a></li>
                            <li><a href="/golf-boys">Golf (boys)</a></li>
                            <li><a href="/golf-girls">Golf (girls)</a></li>
                            <li><a href="/soccer-boys">Soccer (boys)</a></li>
                            <li><a href="/soccer-girls">Soccer (girls)</a></li>
                            <li><a href="/softball">Softball</a></li>
                            <li><a href="/swimming">Swimming</a></li>
                            <li><a href="/tennis-boys">Tennis (boys)</a></li>
                            <li><a href="/tennis-girls">Tennis (girls)</a></li>
                            <li><a href="/track">Track</a></li>
                            <li><a href="/volleyball">Volleyball</a></li>
                            <li><a href="/wrestling">Wrestling</a></li>
                          </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @include('layouts.errors')

        @include('layouts.success')

        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <script>

        $(document).ready(function(){

            //var counter = $('#TextBox').val();
            $('#AddButtonAway').click( function() {
                var counter = $('#away_team_final_score').val();
                counter++ ;
                $('#away_team_final_score').val(counter);
            });
            $('#SubtractButtonAway').click( function() {
                var counter = $('#away_team_final_score').val();
                counter-- ;
                $('#away_team_final_score').val(counter);
            });

            //var counter = $('#TextBox').val();
            $('#AddButtonHome').click( function() {
                var counter = $('#home_team_final_score').val();
                counter++ ;
                $('#home_team_final_score').val(counter);
            });
            $('#SubtractButtonHome').click( function() {
                var counter = $('#home_team_final_score').val();
                counter-- ;
                $('#home_team_final_score').val(counter);
            });
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(700, 0).slideUp(200, function(){
                $(this).remove(); 
            });
        }, 1000);

        jQuery( function() {
            jQuery( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        } );
    </script>

</body>
</html>
