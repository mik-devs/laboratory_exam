<!DOCTYPE html>
<html lang="en">
    @include('partials.header')

    <body class="sb-nav-fixed"> <!-- ITO ANG SUSI! -->
        @include('partials.navbar')

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('partials.sidebar')
            </div>

            <div id="layoutSidenav_content">
                <main>
                    @include('partials.analytics')
                </main>

                @include('partials.footer')
            </div>
        </div>

        @include('partials.scripts')
    </body>
</html>