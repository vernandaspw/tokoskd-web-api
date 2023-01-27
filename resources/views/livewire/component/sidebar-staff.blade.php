<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('vendor/AdminLTE-3.2.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">TOKO SKD</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('vendor/AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->nama }}
                        <div class="">
                            ({{ auth()->user()->role }})
                        </div>
                    </a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                    <li class="nav-item @if(Request::is('/'))
                    menu-open
                    @endif ">
                        <a href="#" class="nav-link @if(Request::is('/'))
                        active
                        @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/', []) }}" class="nav-link  @if(Request::is('/'))
                                active
                                @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ringkasan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/', []) }}" class="nav-link  @if(Request::is('/dashboard-hari'))
                                active
                                @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hari</p>
                                    <span class="right badge badge-danger"> ! </span>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <li class="nav-header">Quick</li>

                    <li class="nav-item">
                        <a href="{{ url('penjualan/kasir') }}" class="nav-link @if(Request::is('penjualan/kasir*'))
                    active
                    @endif">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Mode Kasir
                                {{-- <span class="right badge badge-danger"> ! </span> --}}
                            </p>
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Absensi
                                <span class="right badge badge-danger"> ! </span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Gaji
                                <span class="right badge badge-danger"> ! </span>
                            </p>
                        </a>
                    </li> --}}

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Riwayat harga
                                {{-- <span class="right badge badge-danger"> ! </span> --}}
                            </p>
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Widgets
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li> --}}

                    <li class="nav-header">Keuangan</li>


                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                HutangPiutang
                                <span class="right badge badge-danger"> ! </span>
                            </p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ url('piutang', []) }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Piutang usaha
                                {{-- <span class="right badge badge-danger"> ! </span> --}}
                            </p>
                        </a>
                    </li>



                    <li class="nav-header">Menu</li>
                    <li class="nav-item @if(Request::is('master*'))
                    menu-open
                    @endif ">
                        <a href="#" class="nav-link @if(Request::is('master*'))
                        active
                        @endif">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('master/pelanggan', []) }}" class="nav-link
                                @if(Request::is('master/pelanggan'))
                                active
                                @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pelanggan</p>
                                </a>
                            </li>

                        </ul>
                    </li>



                    <li class="nav-item
                    @if(Request::is('produk*'))
                                menu-open
                                @endif">
                        <a href="#" class="nav-link
                        @if(Request::is('produk*'))
                                active
                                @endif">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Produk
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('produk/produk-satuan') }}" class="nav-link
                                @if(Request::is('produk/produk-satuan'))
                                active
                                @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Produk satuan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('produk/produk-item') }}" class="nav-link
                                @if(Request::is('produk/produk-item'))
                                active
                                @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Produk item</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('produk/produk-stok', []) }}" class="nav-link
                                @if(Request::is('produk/produk-stok'))
                                active
                                @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Produk stok</p>
                                    {{-- <span class="right badge badge-danger"> ! </span> --}}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('produk/produk-diskon', []) }}" class="nav-link
                                @if(Request::is('produk/produk-diskon'))
                                active
                                @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Produk diskon</p>
                                    <span class="right badge badge-danger"> ! </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Stok
                                <i class="right fas fa-angle-left"></i>
                            </p>

                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ringkasan</p>
                                    <span class="right badge badge-danger"> ! </span>
                                </a>
                            </li>

                        </ul>
                    </li> --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Pembelian
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pesanan pembelian</p>
                                    <span class="right badge badge-danger"> ! </span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pembelian</p>
                                    <span class="right badge badge-danger"> ! </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Retur pembelian</p>
                                    <span class="right badge badge-danger"> ! </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Penjualan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pesanan Penjualan</p>
                                    <span class="right badge badge-danger"> ! </span>
                                </a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penjualan</p>
                                    <span class="right badge badge-danger"> ! </span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ url('penjualan/kasir') }}" class="nav-link @if(Request::is('penjualan/kasir*'))
                                active
                                @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mode Kasir</p>
                                    {{-- <span class="right badge badge-danger"> ! </span> --}}
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Retur Penjualan</p>
                                    <span class="right badge badge-danger"> ! </span>
                                </a>
                            </li> --}}
                        </ul>
                    </li>





                    <li class="nav-header">More</li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" onclick="confirm('Anda yakin ingin logout?') || event.stopImmediatePropagation()" wire:click='logout' class="nav-link bg-danger">
                            <i class="nav-icon fas fa-arrow-up "></i>
                            <p class="text">Logout</p>
                        </a>
                    </li>
                    <div class="" style="padding-bottom: 40px"></div>
                    <li class="nav-header text-warning">Apps by Vernanda | V.1.0</li>
                    <li class="nav-header mb-1 text-warning"></li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

</div>
