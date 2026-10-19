<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
   

    @include('partials.navbar')
   
    
      
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">

             @include('partials.sidebar')
                
            </div>

            <div id="layoutSidenav_content">
                <main>
                    @include('partials.analytics')
                @include('partials.footer')
            </div>
        </div>
      
        @include('partials.scripts')
    </body>
</html>
