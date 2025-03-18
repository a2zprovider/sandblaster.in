{{-- @include('frontend.common.header')
@yield('contant')
@include('frontend.common.footer')
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


        @include('frontend.common.header')
    
        @yield('content')
 
        @include('frontend.common.footer')

</body>   
</html>