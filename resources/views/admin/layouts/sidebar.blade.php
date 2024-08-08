@auth('admin')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image" style="padding-top: 10px">
                    <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::user()->name }}
                        <br>
                        <small>{{ Auth::user()->email }}</small></a>
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
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link @if (Route::is('admin.dashboard')) active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.users') }}"
                            class="nav-link @if (Route::is('admin.users') || Route::is('admin.users.edit')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users Management
                            </p>
                        </a>
                    </li>



                    <!--<li class="nav-item menu-close  @if (Route::is('admin.article.edit') || Route::is('admin.article') || Route::is('admin.article.add')) menu-is-opening menu-open @endif ">-->
                    <!--    <a href="#" class="nav-link @if (Route::is('admin.article.edit') || Route::is('admin.article') || Route::is('admin.article.add')) active @endif ">-->
                    <!--        <i class="nav-icon fa fa-rss"></i>-->
                    <!--        <p>-->
                    <!--            Articles-->
                    <!--            <i class="right fas fa-angle-left"></i>-->
                    <!--        </p>-->
                    <!--    </a>-->
                    <!--    <ul class="nav nav-treeview">-->
                    <!--        <li class="nav-item ">-->
                    <!--            <a href="{{ route('admin.article.add') }}"-->
                    <!--                class="nav-link @if (Route::is('admin.article.add'))
active
@endif">-->
                    <!--                <i class="far fa-circle nav-icon"></i>-->
                    <!--                <p>New Articles</p>-->
                    <!--            </a>-->
                    <!--        </li>-->

                    <!--        <li class="nav-item ">-->
                    <!--            <a href="{{ route('admin.article') }}"-->
                    <!--                class="nav-link @if (Route::is('admin.article') || Route::is('admin.article.edit'))
active
@endif">-->
                    <!--                <i class="far fa-circle nav-icon"></i>-->
                    <!--                <p>Articles List</p>-->
                    <!--            </a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</li>-->




                    <li class="nav-item menu-close  @if (Route::is('admin.product') ||
                            Route::is('admin.sub.category') ||
                            Route::is('admin.category') ||
                            Route::is('admin.product.list') ||
                            Route::is('admin.product.edit')) menu-is-opening menu-open @endif ">
                        <a href="#" class="nav-link @if (Route::is('admin.product') ||
                                Route::is('admin.sub.category') ||
                                Route::is('admin.category') ||
                                Route::is('admin.product.list') ||
                                Route::is('admin.product.edit')) active @endif ">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Product Management
                                <i class="fas fa-angle-left right"></i>
                                {{-- <span class="badge badge-info right">6</span> --}}
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.product') }}"
                                    class="nav-link @if (Route::is('admin.product')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product Create</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('admin.product.list') }}"
                                    class="nav-link @if (Route::is('admin.product.list') || Route::is('admin.product.edit')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product List</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.category') }}"
                                    class="nav-link @if (Route::is('admin.category')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product Category</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.sub.category') }}"
                                    class="nav-link @if (Route::is('admin.sub.category')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Product Sub Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item menu-close  @if (Route::is('admin.order') ||
                            Route::is('admin.order.view') ||
                            Route::is('admin.order.leads') ||
                            Route::is('admin.order.leads.view')) menu-is-opening menu-open @endif ">
                        <a href="#" class="nav-link @if (Route::is('admin.order') ||
                                Route::is('admin.order.view') ||
                                Route::is('admin.order.leads') ||
                                Route::is('admin.order.leads.view')) active @endif ">
                            <i class="nav-icon las la-bars"></i>


                            <p>
                                Orders
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('admin.order') }}"
                                    class="nav-link @if (Route::is('admin.order') || Route::is('admin.order.view')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Orders <span
                                            class="right badge badge-danger">{{ App\Models\Order::where('status', 0)->get()->count() }}</span>
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.order.leads') }}"
                                    class="nav-link @if (Route::is('admin.order.leads') || Route::is('admin.order.leads.view')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Orders Leads

                                        @if (App\Models\Lead::where('status', 0)->get()->count() > 0)
                                            <span
                                                class="right badge badge-danger">{{ App\Models\Order::where('status', 0)->get()->count() }}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item menu-close  @if (Route::is('admin.article.edit') || Route::is('admin.article') || Route::is('admin.article.add')) menu-is-opening menu-open @endif ">
                        <a href="#" class="nav-link @if (Route::is('admin.article.edit') || Route::is('admin.article') || Route::is('admin.article.add')) active @endif ">
                            <i class="nav-icon fa fa-rss"></i>
                            <p>
                                Blogs
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{ route('admin.article.add') }}"
                                    class="nav-link @if (Route::is('admin.article.add')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Blogs</p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="{{ route('admin.article') }}"
                                    class="nav-link @if (Route::is('admin.article') || Route::is('admin.article.edit')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blogs List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item menu-close  @if (Route::is('admin.pages.create') ||
                            Route::is('admin.pages') ||
                            Route::is('admin.pages.view') ||
                            Route::is('admin.pages.meta')) menu-is-opening menu-open @endif ">
                        <a href="#" class="nav-link @if (Route::is('admin.pages.create') ||
                                Route::is('admin.pages') ||
                                Route::is('admin.pages.view') ||
                                Route::is('admin.pages.meta')) active @endif ">
                            <i class="nav-icon las la-bars"></i>
                            <p>
                                Pages & Meta
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">


                            <li class="nav-item ">
                                <a href="{{ route('admin.pages.meta') }}"
                                    class="nav-link @if (Route::is('admin.pages.meta')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Custom MetaPages List</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('admin.pages') }}"
                                    class="nav-link @if (Route::is('admin.pages') || Route::is('admin.pages.create') || Route::is('admin.pages.view')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manual Pages</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item menu-close  @if (Route::is('admin.leads') ||
                            Route::is('admin.leads.edit') ||
                            Route::is('admin.leads.edit') ||
                            Route::is('admin.attribute') ||
                            Route::is('admin.testimonial.list') ||
                            Route::is('uploaded-files.index') ||
                            Route::is('admin.subscribe') ||
                            Route::is('uploaded-files.create') ||
                            Route::is('admin.reviews')) menu-is-opening menu-open @endif ">
                        <a href="#" class="nav-link @if (Route::is('admin.leads') ||
                                Route::is('admin.leads.edit') ||
                                Route::is('admin.leads.edit') ||
                                Route::is('admin.attribute') ||
                                Route::is('admin.subscribe') ||
                                Route::is('admin.testimonial.list') ||
                                Route::is('uploaded-files.index') ||
                                Route::is('uploaded-files.create') ||
                                Route::is('admin.reviews')) active @endif ">
                            <i class="nav-icon las la-bell"></i>
                            <p>
                                Others
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('admin.reviews') }}"
                                    class="nav-link @if (Route::is('admin.reviews')) active @endif">
                                    <i class="nav-icon far fa-circle "></i>
                                    <p>Reviews</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.attribute') }}"
                                    class="nav-link @if (Route::is('admin.attribute')) active @endif">
                                    <i class="nav-icon far fa-circle "></i>
                                    <p>Attributes Collection</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.subscribe') }}"
                                    class="nav-link @if (Route::is('admin.subscribe')) active @endif">
                                    <i class="nav-icon far fa-circle "></i>
                                    <p>Subscribe</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.testimonial.list') }}"
                                    class="nav-link @if (Route::is('admin.testimonial.list')) active @endif">
                                    <i class="nav-icon far fa-circle "></i>
                                    <p>Testimonial</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.leads') }}"
                                    class="nav-link @if (Route::is('admin.leads') || Route::is('admin.leads.edit') || Route::is('admin.leads.edit')) active @endif">
                                    <i class="nav-icon far fa-circle "></i>
                                    <p>ContactUs
                                        <span
                                            class="right badge badge-danger">{{ App\Models\ContactLead::where('read_status', 0)->count() }}</span>
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('admin/uploaded-files') }}"
                                    class="nav-link @if (Route::is('uploaded-files.index') || Route::is('uploaded-files.create')) active @endif">
                                    <i class="nav-icon far fa-circle "></i>
                                    <p>
                                        Uploads
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.coupen') }}"
                                    class="nav-link @if (Route::is('admin.coupen')) active @endif">
                                    <i class="nav-icon far fa-circle "></i>
                                    <p>
                                        Coupon
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item menu-close  @if (Route::is('admin.footer') || Route::is('admin.header') || Route::is('admin.pages') || Route::is('admin.slider')) menu-is-opening menu-open @endif ">
                        <a href="#" class="nav-link @if (Route::is('admin.footer') || Route::is('admin.header') || Route::is('admin.pages') || Route::is('admin.slider')) active @endif ">

                            <i class="nav-icon fa fa-building " aria-hidden="true"></i>

                            <p>
                                Appearence
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.header') }}"
                                    class="nav-link @if (Route::is('admin.header')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Header</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.footer') }}"
                                    class="nav-link @if (Route::is('admin.footer')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Footer</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('admin.slider') }}"
                                    class="nav-link @if (Route::is('admin.slider')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Slider</p>
                                </a>
                            </li>

                        </ul>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.logout') }}">
                            <i class=" nav-icon las fas fa-sign-out-alt"></i>

                            {{ __('Logout') }}
                        </a>

                    </li>
                </ul>
            </nav>
        </div>
    </aside>
@endauth
