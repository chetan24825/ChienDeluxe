{{-- <header>
    <ul class="header-right mob-view">
        @guest
            <li><a wire:navigate href="{{ route('user.login') }}" title="Vist Login"><i class="las la-user"></i> Login </a></li>
        @endguest

        @auth
            <li>
                <a wire:navigate href="{{ route('wishlist') }}" title="Vist Wishlist"> <i class="lar la-heart"></i>
                    <span>{{ App\Models\Wishlist::where('user_id', Auth::user()->id)->get()->count() }}</span>
                </a>
            </li>
        @endauth


        <li class="count-act"><a wire:navigate href="{{ route('cart.view') }}" title="Vist Cart">
                  <i class="las la-shopping-cart "></i>
                  @livewire('cart-count-header')
              </a>
        </li>

    </ul>

    <div class="top-bar wow fadeInDown animated ">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <ul class="top-info">
                        @if (get_setting('comany_email'))
                            <li><a href="mailto:{{ get_setting('comany_email') }}" title="Vist Email"><i
                                        class="las la-envelope"></i>{{ get_setting('comany_email') }}</a></li>
                        @endif

                        @if (get_setting('comany_phone'))
                            <li><a href="tel:{{ get_setting('comany_phone') }}" title="Vist Phone"><i class="las la-phone"></i> Call :
                                    {{ get_setting('comany_phone') }}</a></li>
                        @endif

                    </ul>
                </div>

                <div class="col-sm-6">
                    <ul class="top-act">
                        @if (get_setting('facebook_link'))
                            <li><a href="{{ get_setting('facebook_link') }}" title="Visit us on Facebook" ><i class="lab la-facebook-f"></i></a></li>
                        @endif
                        @if (get_setting('instagram_link'))
                            <li><a href="{{ get_setting('instagram_link') }}" title="Visit us on Instagram"><i class="lab la-instagram"></i></a></li>
                        @endif
                        @if (get_setting('linkedin_link'))
                            <li><a href="{{ get_setting('linkedin_link') }}" title="Visit us on Linkedin"><i class="lab la-linkedin-in"></i></a>
                            </li>
                        @endif
                        @if (get_setting('youtube_link'))
                            <li><a href="{{ get_setting('youtube_link') }}" title="Visit us on Youtube"><i class="lab la-youtube"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky middle-header" data-offset="500">
        <div class="container-fluid d-block">
            <div class="row align-items-center">
                <div class="col-md-3 col-6 wow fadeInLeft animated ">
                    <a wire:navigate href="{{ url('/') }}" class="navbar-brand">
                        @if (get_setting('web_logo'))
                            <img loading='lazy' src="{{ uploaded_asset(get_setting('web_logo')) }}" alt="Company Logo">
                        @endif
                    </a>
                </div>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="col-md-5 wow fadeInLeft animated">

                    <form action="{{ route('search.product') }}" method="GET">
                        <div class="search">
                            <input type="search" name="product_name" value="<?php echo isset($searchProduct) ? $searchProduct : old('product_name'); ?>"
                                placeholder="Search Products.." aria-label="Search Products">
                            <button type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 wow fadeInLeft animated">
                    <div class="navbar-collapse collapse justify-content-end" id="navbarContent">
                        <ul class="header-right">
                            @guest
                                @if (Route::has('register'))
                                    <li class="log-register">
                                        <a wire:navigate href="{{ route('user.register') }}" class="regstr-btn">
                                            <i class="las la-user"></i>
                                            <div class="icon-info"><a wire:navigate href="{{route('user.login')}}">Login</a>
                                                <font><a wire:navigate href="/register"><b>Register</b></a></font>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="las la-user"></i>
                                        <div class="icon-info">Welcome!<br>
                                            <font>{{ Str::words(Auth::user()->name, 1, '') }}</font>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @auth('admin')
                                            <a wire:navigate class="dropdown-item" href="{{ route('admin.dashboard') }}"> Admin Dashboard</a>
                                        @endauth
                                        @auth('web')
                                            <a wire:navigate class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                                        @endauth
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                            <i class="las la-power-off"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest

                           <li>
                                <a @guest id="signupbutton1" @endguest
                                    @auth wire:navigate href="{{ route('wishlist') }}" @endauth class="regstr-btn">
                                    <i class="lar la-heart"></i>
                                    <span>
                                        @auth
                                            {{ App\Models\Wishlist::where('user_id', Auth::user()->id)->get()->count() }}
                                        @else
                                            0
                                        @endauth
                                    </span>
                                </a>
                            </li>
                            <li class="count-act">
                                <a @auth wire:navigate href="{{ route('wishlist') }} @endauth">
                                    <div class="icon-info"> Favourite <br>
                                        <font>My Wishlist</font>
                                    </div>
                                </a>
                            </li>
                            <li class="count-act"><a wire:navigate href="{{ route('cart.view') }}">
                                    <i class="las la-shopping-cart "></i>
                                    @livewire('cart-count-header')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg wow fadeInUp cusChetan animated navbar-light bg-white sticky"
        data-offset="500">
        <div class="container-fluid">
            <div class="row menu-bar-head">
                <div class="col-md-7">
                    <div class="navbar-collapse collapse" id="navbarContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item @if (Route::is('webpage')) active @endif">
                                <a  wire:navigate class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item @if (Route::is('product.view')) active @endif">
                                <a  wire:navigate class="nav-link" href="{{ route('product.view') }}">Products</a>
                            </li>
                            @foreach (App\Models\CustomPage::where('status', 1)->Where('viewby', '<>', 0)->Where('viewby', '<>', 3)->orderBy('id', 'asc')->get() as $page)
                                <li class="nav-item {{ Route::is($page->page_name) ? 'active' : '' }}">
                                    <a  wire:navigate class="nav-link" href="{{ $page->link ?? route('custom.page', $page->slug) }}">{{ $page->page_name }}</a>
                                </li>
                            @endforeach
                            <li class="nav-item @if (Route::is('contactus')) active @endif">
                                <a wire:navigate class="nav-link" href="{{ route('contactus') }}">Contact Us</a>
                            </li>
                        </ul>
                        <ul class="header-right">
                        </ul>
                    </div>
                </div>


                <div class="col-md-5">
                    <div class="latest-trend">
                        <h3><i class="las la-rss"></i> Latest News:</h3>
                        <div class="content-slider">
                            <div class="slider">
                                <div class="mask">
                                    <ul>
                                        @foreach (explode('||', get_setting('latest_news')) as $key => $tag)
                                            <li class="anim{{ ++$key }}">
                                                <div class="quote"><a href="#">{{ $tag }} </a></div>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--<p class="sale-tag"><i class="las la-tags"></i> Sale $20 Off Your First Order.</p>-->
        </div>
    </nav>

</header> --}}



<div class="mobile-header">
    <header>
        <div class="mid-header">
            <div class="container">
                <div class="row align-items-center justify-content-start">
                    <div class="col-sm-4 mobile-upper">
                        <div class="logo">
                            <a wire:navigate href="{{ url('/') }}">
                                @if (get_setting('web_logo'))
                                    <img loading='lazy' src="{{ uploaded_asset(get_setting('web_logo')) }}"
                                        class="img-fluid" width="60" alt="Company Logo">
                                @endif
                            </a>
                        </div>



                        <ul class="right-function">

                            <li><a href="#"><i class="las la-search" onclick="openForm()"></i></a></li>

                            @guest
                                <li><a wire:navigate href="{{ route('user.login') }}" title="Vist Login"><i
                                            class="las la-user"></i> Login </a></li>
                            @endguest

                            <li><a wire:navigate href="{{ route('cart.view') }}" title="Vist Cart"><i
                                        class="las la-shopping-bag"></i>
                                    @livewire('cart-count-header')
                                </a>
                            </li>

                            @auth
                                <li>
                                    <a wire:navigate href="{{ route('wishlist') }}" title="Vist Wishlist"> <i
                                            class="lar la-heart"></i>
                                        @livewire('component-wishlist-count')
                                    </a>
                                </li>
                            @endauth
                        </ul>



                        <div class="main-menu">
                            <nav class="navbar navbar-expand-lg navbar-light bg-transparent">


                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link @if (Route::is('webpage')) active @endif"
                                                aria-current="page" href="{{ route('webpage') }}">Home</a>
                                        </li>

                                        @foreach (App\Models\Category::where('status', 1)->whereIn('visible', [0, 1])->orderBy('sort', 'ASC')->take(6)->get() as $category)
                                            <li class="nav-item ">
                                                <a wire:navigate title="{!! $category->category_name !!}"
                                                    href="{{ route('category.detail', $category->slug) }}"
                                                    class="nav-link  {{ request()->segment(2) === $category->slug ? 'active' : '' }} "
                                                    title="{{ $category->category_name }}">{{ $category->category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>

<header class="desktop-header">
    <div class="mid-header">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-4 text-center">
                    <div class="logo">
                        <a href="#">
                            <h1>
                                {{ get_setting('latest_news') }}
                            </h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mid-header mt-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-1">
                    <div class="logo">
                        <a wire:navigate href="{{ url('/') }}">
                            @if (get_setting('web_logo'))
                                <img loading='lazy' src="{{ uploaded_asset(get_setting('web_logo')) }}"
                                    class="img-fluid" width="60" alt="Company Logo">
                            @endif
                        </a>
                    </div>
                </div>

                <div class="header-right col-md-11">
                    <div class="col-md-7">
                        <div class="search">
                            <ul class="right-function justify-content-start p-0">
                                <li><a href="#"><i class="las la-search" onclick="openForm()"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <ul class="right-function">
                            @guest
                                <li><a wire:navigate href="{{ route('user.login') }}" title="Vist Login"><i
                                            class="las la-user"></i></a></li>
                            @endguest


                            <li><a wire:navigate href="{{ route('cart.view') }}" title="Vist Cart"><i
                                        class="las la-shopping-bag"></i>
                                    @livewire('cart-count-header')

                                </a>
                            </li>

                            @auth
                                <li>
                                    <a wire:navigate href="{{ route('wishlist') }}" title="Vist Wishlist"> <i
                                            class="lar la-heart"></i>
                                        @livewire('component-wishlist-count')
                                    </a>
                                </li>
                            @endauth


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="main-menu">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link @if (Route::is('webpage')) active @endif" aria-current="page"
                                href="{{ route('webpage') }}">Home</a>
                        </li>
                        @foreach (App\Models\Category::where('status', 1)->whereIn('visible', [0, 1])->orderBy('sort', 'ASC')->take(6)->get() as $category)
                            <li class="nav-item ">
                                <a wire:navigate title="{!! $category->category_name !!}"
                                    href="{{ route('category.detail', $category->slug) }}"
                                    class="nav-link  {{ request()->segment(2) === $category->slug ? 'active' : '' }} "
                                    title="{{ $category->category_name }}">{{ $category->category_name }}</a>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </nav>
    </div>

</header>

<div class="form-popup" id="myForm">
    <form action="{{ route('search.product') }}" method="GET" class="form-container stop-propagation">
        <div class="serch-here">
            <input type="text" name="product_name" value="<?php echo isset($searchProduct) ? $searchProduct : old('product_name'); ?>" placeholder="Search Products.."
                aria-label="Search Products">
            <button type="submit" class="btn"><i class="las la-search"></i></button>
        </div>
        <button type="button" class="btn cancel" onclick="closeForm()"><i class="las la-times"></i></button>
    </form>
</div>
