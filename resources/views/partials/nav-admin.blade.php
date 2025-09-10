<div id="sticky-header" class="main-header-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-3 col-lg-3">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo1.png') }}" alt="">
                    </a>
                </div>
            </div>
                <div class="col-xl-9 col-lg-9">
                    <div class="main-menu  d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li><a href="{{ route('admin.managers.index') }}">Managers</a></li>
                                <li><a href="{{ route('admin.store') }}">Store</a></li>
                                <li><a href="/">Donation</a></li>
                                <li><a href="/">Pets</a></li>
                                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route('admin.pets.adoptions') }}">History</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-link">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </nav>
                </div>
                </div>
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>