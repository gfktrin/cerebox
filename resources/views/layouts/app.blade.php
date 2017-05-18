<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!--Fonts-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        .footer{ 
        width:100%; 
        float:left; 
        background: #E0E0E0; 
        height:250px; 
        text-align: center; 
        } 
        #social-list{ 
          list-style: none; 
          display: inline-flex; 
          margin-left: -40px; 
        } 
        #social-list > li > a > i{ 
          font-size:36px; 
        } 
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        window.webRoot = '{{ url('') }}'+'/';
    </script>
    <script src="https://use.fontawesome.com/64f3d0c6e3.js"></script>
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
                        {{-- config('app.name', 'Cerebox') --}}
                        <img src="{{ asset('images/cerebox-logo.jpg') }}" alt="Cerebox Logo">
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
                        <li><a href="{{ action('HomeController@openContests') }}">Concursos abertos</a></li>
                        <li><a href="http:\\randomizador.cerebox.com.br">Randomizador</a></li>
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
                                    <li><a href="{{ action('HomeController@myProjects') }}">Meus Projetos</a></li>
                                    <li><a href="{{ action('HomeController@acquireTickets') }}">Adquirir Tickets</a></li>
                                    @if(Auth::user()->admin)
                                        <li><a href="{{ action('AdminController@home') }}">Área Administrativa</a></li>
                                    @endif
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
                            <li>
                                <a href="{{ action('HomeController@acquireTickets') }}" title="Tickets"> 
                                    {{ Auth::user()->tickets }} <span class="fa fa-ticket"></span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            @yield('content')
        </div>
    </div>
    <footer class="footer">
        <h3>Nossas redes sociais</h3>
        <ul id="social-list">
            <li>
                <a href="" class="btn btn-primary pull-right">
                    <i class="fa fa-facebook-official"></i>
                </a>
            </li>
            <li>
                <a href="" class="btn btn-primary pull-right">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
            <li>
                <a href="" class="btn btn-primary pull-right">
                    <i class="fa fa-twitter-square"></i>
                </a>
            </li>
            <li>
                <a href="" class="btn btn-primary pull-right">
                    <i class="fa fa-youtube-play"></i>
                </a>
            </li>
        </ul>
        <p class="text-muted">Cerebox desenvolvido por Uniriotec Consultoria</p>
        <div class="col-md-12">
            <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=cerebox.com.br','SiteLock','width=600,height=600,left=160,top=170');" ><img alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/cerebox.com.br" /></a>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('#myModal').modal('show');
    </script>
</body>
</html>
