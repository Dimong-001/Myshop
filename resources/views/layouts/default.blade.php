<!DOCTYPE html>
<html lang="en">

@include('includes.head')

<body>
    <div class="page-wrapper">
        @include('includes.header')
        @yield('contents')
        @include('includes.footer')
    </div><!-- End .page-wrapper -->
    @include('includes.uderfooter')
</body>
<!-- molla/index-3.html  22 Nov 2019 09:55:58 GMT -->
</html>