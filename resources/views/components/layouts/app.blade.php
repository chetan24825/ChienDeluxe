<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('fronts.layouts.header')

<body>
    <div class="back-to-top"></div>
    @include('fronts.layouts.topbar')
    {{ $slot }}

    @include('fronts.layouts.footer')
    @include('fronts.layouts.script')

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

        window.livewire.on('usernameValidated', () => {
            // Username is valid
        });
    </script>

</body>

</html>
