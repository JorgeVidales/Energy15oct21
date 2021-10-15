<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        function autoClave() {
            var chars = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
            var string_length = 8;
            var randomstring = "";
            var charCount = 0;
            var numCount = 0;

            for (var i = 0; i < string_length; i++) {
                // If random bit is 0, there are less than 3 digits already saved, and there are not already 5 characters saved, generate a numeric value.
                if (
                (Math.floor(Math.random() * 2) == 0 && numCount < 3) ||
                charCount >= 5
                ) {
                var rnum = Math.floor(Math.random() * 10);
                randomstring += rnum;
                numCount += 1;
                } else {
                // If any of the above criteria fail, go ahead and generate an alpha character from the chars string
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum, rnum + 1);
                charCount += 1;
                }
            }

            // alert(randomstring);
            $('#autocodigo').text(randomstring);
            $("#autocodigo").css({"background": "#8ed290",
                                    "padding": "3px 17px 5px 17px",
                                    "color": "#212121",
                                    "font-size": "19px",
                                    "position": "relative",
                                    "top": "4px",
                                    "font-weight": "bold"
                                });
            
        }
        
        function verPassword(){

            if( $('#flexSwitchCheckDefault').is(':checked') ) {
                $("#password").attr('type', 'text');
                $(".passworconfirm").attr('type', 'text');
                // alert('Seleccionado');
            }else{
                $("#password").attr('type', 'password');
                $(".passworconfirm").attr('type', 'password');
            }
        }
    </script>

</body>
</html>
