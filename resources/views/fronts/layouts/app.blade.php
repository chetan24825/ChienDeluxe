<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('fronts.layouts.header')
<body>

    @include('fronts.layouts.topbar')
    @yield('content')
    @include('fronts.layouts.footer')
    @include('fronts.layouts.script')
    @include('fronts.inc.banner')


    <script>
        window.addEventListener('show-flash', function(e) {
            toastr.success(e.detail[0].message);
        })
        window.addEventListener('error-flash', function(e) {
            toastr.danger(e.detail[0].message);
        })
        window.addEventListener('warning-flash', function(e) {
            toastr.warning(e.detail[0].message);
        })
    </script>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('refreshComponent', () => {
                Livewire.emit('refreshComponent'); // Trigger a Livewire re-render
            });
        });
    </script>

</body>

</html>
