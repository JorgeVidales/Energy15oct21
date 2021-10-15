<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div id="app">
            

            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <ejemplo></ejemplo>
                    </div>
                    <div class="col-6">
                        <h1>Parte 2</h1>
                    </div>
                </div>
                
            </div>
            
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>