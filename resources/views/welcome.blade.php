<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cerebox</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
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
                        {{ config('app.name', 'Cerebox') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="{{ action('HomeController@howToParticipate') }}">Como participar</a></li>
                        <li><a href="{{ action('ContactController@index') }}">Contato</a></li>
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Cadastrar</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ action('HomeController@editUser') }}">Editar Perfil</a></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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

        <div class="content">
            <!--Slider Home-->
            <section id="home">
                <div class="carousel slide" id="slider-home" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="{{ asset('images/A9U0Eex.png') }}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{ asset('images/A9U0Eex.png') }}" width="100%" alt="">
                            <div class="carousel-caption">
                                Something Here
                            </div>
                        </div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <i class="material-icons" aria-hidden="true">navigate_before</i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <i class="material-icons" aria-hidden="true">navigate_next</i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>

            <div class="col-md-8 col-md-offset-2">

                <!--Concursos-->
                <section class="row">
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="panel-img">
                                    <img src="{{ asset('images/penguin2.jpg') }}" width="100%" alt="penguin">
                                </div>
                                <h3>Concurso 1</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="panel-img">
                                    <img src="{{ asset('images/penguin1.jpg') }}" width="100%"  alt="penguin">
                                </div>
                                <h3>Concurso 2</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="panel-img">
                                    <img src="{{ asset('images/penguin3.jpg') }}" width="100%" alt="penguin">
                                </div>
                                <h3>Concurso 3</h3>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <h2 class="text-center">Quem Somos</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque condimentum congue metus, at blandit nulla mollis quis. Aenean rutrum urna nunc, ut maximus nulla molestie vitae. Suspendisse molestie eros purus, vitae gravida sapien rutrum eu. Quisque lacinia ac tellus id venenatis. Praesent lorem risus, bibendum at tortor non, feugiat gravida nisl. Fusce nec lobortis libero, eu ultrices magna. Mauris at sodales lacus. Suspendisse sed libero cursus, malesuada nisi nec, efficitur turpis. Proin lobortis feugiat odio, at vestibulum tellus feugiat at. Nunc id mi ipsum.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
