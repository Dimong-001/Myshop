<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<!-- head -->
<body>
    <div class="page-wrapper">
        @include('includes.header')
        @include('includes.main')
        @yield('content')
    </div>
@include('includes.footer')    
</body>

<!-- molla/index-3.html  22 Nov 2019 09:55:58 GMT -->
</html>