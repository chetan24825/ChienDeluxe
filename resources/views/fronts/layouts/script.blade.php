<script src="{{ asset('front/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.js') }}"></script>
<script src="{{ asset('front/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('front/js/theme.js') }}"></script>
{{-- <script src="{{ asset('front/js/axios.min.js') }}"></script> --}}
{{-- <script src="{{ asset('front/js/slick.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>
<script>
    (function($) {
        "use strict";
        $("#product-main-img").slick({
            infinite: true,
            speed: 300,
            dots: false,
            arrows: true,
            fade: true,
            asNavFor: "#product-imgs",
        });

        $("#product-imgs").slick({
            slidesToShow: 10,
            slidesToScroll: 1,
            arrows: true,
            centerMode: true,
            focusOnSelect: true,
            centerPadding: 0,
            vertical: true,
            asNavFor: "#product-main-img",
            responsive: [{
                breakpoint: 991,
                settings: {
                    vertical: false,
                    arrows: false,
                    dots: true,
                },
            }, ],
        });
    })(jQuery);
</script>

@livewireScripts
@yield('script')
<script>
    $(document).ready(function() {
        $("#signupbutton").click(function() {
            $('#signup').modal('show');
        });
    });
    $(document).ready(function() {
        $("#signupbutton1").click(function() {
            $('#signup').modal('show');
        });
    });
</script>
