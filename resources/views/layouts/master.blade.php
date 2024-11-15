<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials._head')

    <!-- Inclure les assets générés par Vite -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.partials._navbar')

        <!-- Main Sidebar Container -->
        @include('layouts.partials._sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="app">
            @include('flash::message')

            <!-- Contenu principal -->
            @yield('content')
        </div> 

        <!-- Footer -->
        @include('layouts.partials._footer')
    </div>

    <!-- Scripts supplémentaires -->
    @include('layouts.partials._footer-script')

</body>
</html>
