<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-secondary">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-80">
                <a href="/"
                    class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                    id="menu">
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link align-middle px-0 text-white">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>

                    {{-- <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi-speedometer2"></i> <span
                                class="ms-1 d-none d-sm-inline text-white">Dashboard </span> <i
                                class="bi bi-caret-down-fill"></i> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Item</span> </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Item</span>  </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class=" fs-4 bi bi-diagram-3"></i> <span class="ms-1 d-none d-sm-inline ">Direct
                                Referrals</span></a>
                    </li>


                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi bi-diagram-3"></i>
                            <span class="ms-1 d-none d-sm-inline ">Affiliate Commission </span></a>
                    </li>



                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4  bi-wallet2"></i> <span class="ms-1 d-none d-sm-inline ">Wallet</span></a>
                    </li>



                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi-bag-check-fill"></i> <span
                                class="ms-1 d-none d-sm-inline ">Orders</span></a>
                    </li>


                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi bi-gift"></i> <span class="ms-1 d-none d-sm-inline ">Rewards</span></a>
                    </li>


                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline ">Passbook</span></a>
                    </li>


                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi-bag-check-fill"></i> <span class="ms-1 d-none d-sm-inline ">Order
                                Tracking</span></a>
                    </li>


                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi bi-pip-fill"></i> <span class="ms-1 d-none d-sm-inline"> Distributor
                            </span></a>
                    </li>


                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline"> Seller </span></a>
                    </li>


                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi bi-sliders"></i> <span class="ms-1 d-none d-sm-inline">Referral Code
                            </span></a>
                    </li>

                    {{-- <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline ">Bootstrap</span> <i
                                class="bi bi-caret-down-fill"></i></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline text-white"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Item</span> </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline text-white"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Item</span> </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> <i
                                class="bi bi-caret-down-fill"></i></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline text-white"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Product</span> </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Product</span> </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Product</span> </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Product</span> </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                    </li> --}}
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img loading='lazy' src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                            class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1 text-white">loser</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">

        </div>
    </div>
</div>
