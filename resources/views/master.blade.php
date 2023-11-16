<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
      @yield('maintitle')
    </title>

    @stack('mainstyle')

    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icons/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icons/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icons/css/solid.css') }}">
  </head>
  <body>

    @yield('mainsection')

    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    
    @stack('mainscript')

  </body>
</html>