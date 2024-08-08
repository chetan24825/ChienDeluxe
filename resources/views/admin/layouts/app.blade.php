<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.header')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.layouts.nav')
        
        @include('admin.layouts.sidebar')
        @yield('admin-content')

        @include('admin.layouts.footer')
    </div>
    @include('admin.layouts.script')
</body>

</html>
