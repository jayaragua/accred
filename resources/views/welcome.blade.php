<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GADTC Accreditation</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
         <link href="/css/all.css" rel="stylesheet">

         <script>
             
              (function (){
                    window.Laravel = {
                        csrfToken: '{{ csrf_token() }}'
                    };
              })();  



         </script>

    </head>
    <body>
     

        <div id="app">
          @if(Auth::check())
            <mainapp :user="{{Auth::user('id')}}"></mainapp>
          @else
            <mainapp :user="false"></mainapp>
          @endif
        </div>
    </body>


    
    <script src="{{mix('/js/app.js')}}"></script>
</html>

