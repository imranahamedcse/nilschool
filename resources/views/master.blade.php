<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" name="url" id="url" value="{{ url('') }}">
    
    <!-- Delete alert confarmation text-->
    <input type="hidden" id="alert_title" value="{{ ___('common.Are you sure?') }}">
    <input type="hidden" id="alert_subtitle" value="{{ ___('common.You wont be able to revert this!') }}">
    <input type="hidden" id="alert_yes_btn" value="{{ ___('common.Yes') }}">
    <input type="hidden" id="alert_cancel_btn" value="{{ ___('common.No') }}">


    <title>
        @yield('maintitle')
    </title>

    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icons/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icons/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icons/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/light-style.css') }}" id="theme-style" disabled>
    <link rel="stylesheet" href="{{ asset('backend/css/dark-style.css') }}" id="dark-theme-style" disabled>
    <link rel="stylesheet" href="{{ asset('backend/css/nice-select.min.css') }}" />

    @stack('mainstyle')

</head>

<body>

    @yield('mainsection')

    <!-- light/dark theme start -->
    <script>
        const theme = localStorage.getItem("theme");
        document.querySelector("html").setAttribute("data-bs-theme", theme ?? 'light');

        const themeElement = document.getElementById('theme');
        const themeStyle = document.getElementById('theme-style');
        const darkThemeStyle = document.getElementById('dark-theme-style');

        if (theme === 'light' || theme === null) {
            themeElement.innerHTML = '<i class="fa-solid fa-sun"></i>';
            darkThemeStyle.setAttribute("disabled", true);
            themeStyle.removeAttribute("disabled");
        } else {
            themeElement.innerHTML = '<i class="fa-solid fa-moon"></i>';
            themeStyle.setAttribute("disabled", true);
            darkThemeStyle.removeAttribute("disabled");
        }
    </script>
    <!-- light/dark theme end -->

    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.nice-select.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select').niceSelect();
        });
    </script>

    @stack('mainscript')

</body>

</html>
