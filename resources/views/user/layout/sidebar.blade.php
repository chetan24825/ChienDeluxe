@auth('web')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image" style="padding-top: 10px">

                    @if (Auth::user()->profile_image)
                        <img class="img-circle elevation-2" src="{{ uploaded_asset(Auth::user()->profile_image) }}"
                            alt="User profile picture">
                    @else
                        <img class="img-circle elevation-2" src="{{ asset('backend/dist/img/user.png') }}"
                            alt="User profile picture">
                    @endif
                </div>
                <div class="info">
                    <a href="{{ route('home') }}" class="d-block">{{ Auth::user()->name }}
                        <br>
                        <small>{{ Auth::user()->email }}</small>
                    </a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>


            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link @if (Route::is('home')) active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <span class=" right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('webpage') }}" class="nav-link">
                           <!--<i class="nav-icon fas fa-truck"></i>-->
                           <!--<i class="nav-icon las la-shopping-cart"></i>-->
                           <i class="nav-icon fa fa-shopping-cart" aria-hidden="true"></i>

                            <p>
                                Shop Now
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('user.profile') }}"
                            class="nav-link @if (Route::is('user.profile')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                My Profile

                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('user.order') }}"
                            class="nav-link @if (Route::is('user.order')) active @endif">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                My Orders
                            </p>
                        </a>
                    </li>


                    {{-- <li class="nav-item">
                        <a href="{{ route('user.level') }}"
                            class="nav-link @if (Route::is('user.level') || Route::is('user.level1')) active @endif">
                            <i class="nav-icon  fas fa-wallet"></i>
                            <p>
                                Affiliate Earnings
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.directreffer') }}"
                            class="nav-link @if (Route::is('user.directreffer')) active @endif">
                            <i class="nav-icon las la-vector-square"></i>
                            <p>
                                My Network
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.withdrawal') }}"
                            class="nav-link @if (Route::is('user.withdrawal')) active @endif">
                            <i class="nav-icon las la-money-check"></i>
                            <p>
                                Withdrawals

                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.transaction') }}"
                            class="nav-link @if (Route::is('user.transaction')) active @endif">
                            <i class="nav-icon las la-exchange-alt"></i>
                            <p>
                                Transactions
                            </p>
                        </a>
                    </li> --}}


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                            <i class=" nav-icon las fas fa-sign-out-alt"></i>

                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
@endauth
