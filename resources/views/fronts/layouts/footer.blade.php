<footer>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h5>Legals</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a wire:navigate href="{{ route('order.track') }}" title="Track your order"
                            class="nav-link p-0 text-muted">Order
                            Track</a></li>
                    <li class="nav-item mb-2"><a wire:navigate href="{{ route('contactus') }}" title="Contact Us"
                            class="nav-link p-0 text-muted">Contact Us</a></li>
                    @foreach (App\Models\CustomPage::where('status', 1)->Where('viewby', '<>', 1)->Where('viewby', '<>', 3)->get() as $page)
                        <li class="nav-item mb-2"><a wire:navigate
                                href="{{ $page->link ?? route('custom.page', $page->slug) }}"
                                class="nav-link p-0 text-muted"
                                title="{{ $page->page_name }}">{{ $page->page_name }}</a>
                        </li>
                    @endforeach

                    <li class="nav-item mb-2"><a href="{{ route('sitemap') }}" title="View our sitemap"
                            class="nav-link p-0 text-muted">Sitemap.xml</a></li>
                </ul>
            </div>

            <div class="col-2">
                <h5>Categories</h5>
                <ul class="nav flex-column">
                    @foreach (App\Models\Category::where('status', 1)->whereIn('visible', [0, 2])->orderByDesc('id')->limit(5)->get() as $category)
                        <li class="nav-item mb-2">
                            <a wire:navigate title="{!! $category->category_name !!}" class="nav-link p-0 text-muted"
                                href="{{ route('category.detail', $category->slug) }}">{{ $category->category_name }}</a>
                        </li>
                    @endforeach


                </ul>
            </div>

            <div class="col-2">
                <h5>Categories</h5>
                <ul class="nav flex-column">
                    @foreach (App\Models\Category::where('status', 1)->whereIn('visible', [0, 2])->orderByDesc('id')->skip(5)->take(5)->get() as $category)
                        <li class="nav-item mb-2">
                            <a wire:navigate title="{!! $category->category_name !!}"
                                href="{{ route('category.detail', $category->slug) }}" class="nav-link p-0 text-muted"
                                title="{{ $category->category_name }}">{{ $category->category_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-4 offset-1">
                @if (get_setting('web_logo'))
                    <img loading='lazy' width="200" class="img-fluid"
                        src="{{ uploaded_asset(get_setting('web_logo')) }}" alt="Company Logo">
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between py-4 my-4 border-top mb-0">
            @if (get_setting('copy_right'))
                <p>{!! get_setting('copy_right') !!}</p>
            @endif
            <ul class="list-unstyled d-flex">

                @if (get_setting('facebook_link'))
                    <li class="ms-3"><a class="link-dark" href="{{ get_setting('facebook_link') }}"
                            title="Visit us on Facebook"><i class="lab la-facebook-f"></i></a></li>
                @endif

                @if (get_setting('instagram_link'))
                    <li class="ms-3"><a class="link-dark" href="{{ get_setting('instagram_link') }}"
                            title="Visit us on Instagram"><i class="lab la-instagram"></i></a></li>
                @endif

                @if (get_setting('linkedin_link'))
                    <li class="ms-3"><a class="link-dark" href="{{ get_setting('linkedin_link') }}"
                            title="Visit us on Linkedin"><i class="lab la-linkedin-in"></i></a></li>
                @endif

                @if (get_setting('youtube_link'))
                    <li class="ms-3"><a class="link-dark" href="{{ get_setting('youtube_link') }}"
                            title="Visit us on Youtube"><i class="lab la-youtube"></i></a></li>
                @endif

            </ul>
        </div>
    </div>
</footer>




{{--
@livewire('cart-count-footer')

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    @livewire('footercarts')
</div>




<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
</script> --}}
