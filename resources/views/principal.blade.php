<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="img/energyFav.png">
    <title>Sistema Ventas - IncanatoIT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">




</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">


    <div id="app">
        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Escritorio</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Configuraciones</a>
            </li>
        </ul> -->
            <ul style="margin: 0px 24px;" class="nav navbar-nav ml-auto">
                <!-- <li class="nav-item d-md-down-none">
                    <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="icon-bell"></i>
                        <span class="badge badge-pill badge-danger">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-center">
                            <strong>Notificaciones</strong>
                        </div>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-envelope-o"></i> Ingresos
                            <span class="badge badge-success">3</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-tasks"></i> Ventas
                            <span class="badge badge-danger">2</span>
                        </a>
                    </div>
                </li> -->



                <li id="cerrarSecc" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        <span class="d-md-down-none Username">{{ Auth::user()->name }} </span>
                    </a>
                    <div id="cerrar" class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-center">
                            <strong>Cuenta</strong>
                        </div>
                        <!-- <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Perfil</a> -->
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <i class="fa fa-lock"></i> Cerrar sesión</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            {{csrf_field()}}
                        </form>
                    </div>
                </li>


            </ul>
        </header>

        <div class="app-body">

            @if (Auth::check())
                @if (Auth::user()->usuarioTiposimple == 'Administrador')
                    @include('plantilla.sidebaradministrador')
                @elseif(Auth::user()->usuarioTiposimple == 'Cliente')
                    @include('plantilla.sidebarcliente')
                @endif
            @endif

            <!-- Contenido Principal -->
            @yield('contenido')
            <!-- /Fin del contenido principal -->
        </div>
    </div>


    <footer class="app-footer">
        <span><a href="#">Jorge Vidales</a> &copy; <?php echo date("Y"); ?></span>
        <span class="ml-auto">Desarrollado por <a href="#">Jorge Vidales</a></span>
    </footer>


    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>

    <script>
        // function abrir() {

        //     // alert('hola');
        //     //  document.getElementById("cerrar").style.display = "block!important";
        //     //   $("#cerrar").css("display", "none");
        // }
        // $("#cerrarSecc").click(function(){

        //     alert('diste click');
        //     return
        // })

        // $("body").click(function(){

        // alert('diste click body');

        // })


        // $(document).on("click", function(e) {

        //     var container = $("#cerrarSecc");

        //     console.log(!container.is(e.target));

        //     if (!container.is(e.target) && container.has(e.target).length === 0) {
        //         // alert("¡Pulsaste fuera!");
        //         // document.getElementById("cerrar").style.display = "none";
        //         // $("#cerrar").css("display", "none");
        //         $("#cerrar").css("display", "none");
        //     }
        //     if(container.length === null){
        //         $("#cerrar").css("display", "block");
        //     }


        // });
    </script>
    <script>
        // function miFuncion() {
        //     alert('OK');
        // }
        // window.onload = miFuncion;
    </script>

</body>

</html>