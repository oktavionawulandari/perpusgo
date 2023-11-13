<nav class="navbar fixed-top" style="background-color:#757BC8">
    <div class="container-fluid">
        <button class="btn text-light" data-bs-toggle="offcanvas" href="#offcanvasExample" type="button"
            aria-controls="offcanvasExample">
            <i class="bi bi-list" style="font-size:1.5rem;"></i>
        </button>
        <a class="nav-link active float-end text-light fs-5" aria-current="page" href="{{route('home.pegawai')}}">PerpusGo</a>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel" style="width: 250px;">
            <div class="offcanvas-header mt-2">
                <h4 class="offcanvas-title " id="offcanvasExampleLabel">Menu</h4>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mt-2">
                <div class="text-center">
                    <a href="{{route('pegawai.editprofile')}}">
                        <i class="bi bi-person-circle" style="font-size:2rem;color:black"></i>
                    </a>
                    <div class="mt-1 fs-6">
                        {{Auth::guard('user')->user()->nama}} <br>
                        - {{Auth::guard('user')->user()->role}} -
                    </div>
                </div>
                <hr>
                <div class="d-flex flex-column flex-shrink-1 p-2">
                    <div class="list-group">
                        </a>
                        <a href="{{route('home.pegawai')}}"
                            class="navbar-brand list-group-item list-group-item-action border-0"><i
                                class="bi bi-house-door-fill me-1" style="font-size:1.5rem;"></i>
                            Home
                        </a>
                        <a href="{{route('anggota.index')}}"
                            class="navbar-brand list-group-item list-group-item-action border-0"><i
                                class="bi bi-people-fill me-1" style="font-size:1.5rem;"></i>
                            Anggota
                        </a>
                        <a href="{{route('buku.index')}}"
                            class="navbar-brand list-group-item list-group-item-action border-0"><i
                                class="bi bi-book-half me-1" style="font-size:1.5rem;"></i>
                            Buku
                        </a>
                        <a href="{{route('pegawai.index')}}"
                            class="navbar-brand list-group-item list-group-item-action border-0"><i
                                class="bi bi-person-badge-fill me-1" style="font-size:1.5rem;"></i>
                            Pegawai
                        </a>
                        <a href="{{route('transaksi.index')}}"
                            class="navbar-brand list-group-item list-group-item-action border-0"><i
                                class="bi bi-arrow-left-right me-1" style="font-size:1.5rem;"></i>
                            Transaksi
                        </a>

                    </div>
                    <hr>
                    <!--logout button-->
                    <div class="d-grid">
                        <a href="{{route('logout')}}" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>