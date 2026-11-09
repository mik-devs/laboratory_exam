<!DOCTYPE html>
<html lang="en">
    <title>Dashboard - SB Admin</title>
    @include('partials.header')

    <body class="sb-nav-fixed"> 
        @include('partials.navbar')

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('partials.sidebar')
            </div>

            <div id="layoutSidenav_content">
                <main>
                    @include('partials.analytics')
                </main>

               
            </div>
            
        </div>
         @include('partials.footer')
        @include('partials.scripts')

        
    </body>
</html>