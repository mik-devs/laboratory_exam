<!DOCTYPE html>
<html lang="en">
    @include('partials.header')

    <body class="@yield('body-class', 'sb-nav-fixed')">
        @include('partials.navbar')

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('partials.sidebar')
            </div>

            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                @include('partials.footer')
            </div>
        </div>

        @include('partials.scripts')
    </body>
</html>