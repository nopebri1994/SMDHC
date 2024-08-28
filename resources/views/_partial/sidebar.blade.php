<aside class="main-sidebar main-sidebar-custom sidebar-light-orange elevation-4">

    <a href="#" class="brand-link bg-gray-dark">
        <img src="{{ URL::to('/') }}/assets/img/logo.png" alt="LMW Logo" class="brand-image elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SMDHC</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ URL::to('/') }}/assets/img/icon.png" class="img-circle elevation-2 bg-gray-dark"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->karyawan->namaKaryawan }}</a>
            </div>
        </div>

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
        <hr>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ URL::to('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item  {{ request()->is('dk/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('dk/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fas fa-user-cog"></i>
                        <p>
                            Data Karyawan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/') }}/dk/karyawan"
                                class="nav-link  {{ request()->is('dk/karyawan') ? 'active' : '' }}
                                {{ request()->is('dk/karyawan/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Karyawan</p>
                            </a>
                        </li>
                        @can('hc')
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/dk/karyawanKeluar"
                                    class="nav-link  {{ request()->is('dk/karyawanKeluar') ? 'active' : '' }}
                                {{ request()->is('dk/karyawan/*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Karyawan Keluar</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-item  {{ request()->is('psn/*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ request()->is('psn/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fas fa-users"></i>
                        <p>
                            Personalia
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL::to('/') }}/psn/absensi"
                                class="nav-link {{ request()->is('psn/absensi') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proses Absensi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/') }}/psn/absensiHarian"
                                class="nav-link {{ request()->is('psn/absensiHarian') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Absensi Harian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/') }}/psn/cetakAbsensi"
                                class="nav-link {{ request()->is('psn/cetakAbsensi') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cetak Absensi</p>
                            </a>
                        </li>
                        @can('hc')
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/psn/mesinAbsensi-sync"
                                    class="nav-link {{ request()->is('psn/mesinAbsensi-sync') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sync Mesin Absen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/psn/potongan-cuti"
                                    class="nav-link {{ request()->is('psn/potongan-cuti') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Potongan Cuti Tahunan</p>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ URL::to('/') }}/psn/cuti"
                                class="nav-link {{ request()->is('psn/cuti') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cuti Karyawan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::to('/') }}/psn/hutang-cuti"
                                class="nav-link {{ request()->is('psn/hutang-cuti') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hutang Cuti Karyawan</p>
                            </a>
                        </li>
                        @can('hc')
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/psn/kontrak-karyawan"
                                    class="nav-link {{ request()->is('psn/kontrak-karyawan') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kontrak Karyawan</p>
                                    <span class="right badge badge-danger">P</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penghargaan Masa Kerja</p>
                                    <span class="right badge badge-danger">P</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Surat Peringatan</p>
                                    <span class="right badge badge-danger">P</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('hc')
                    <li class="nav-item {{ request()->is('dm/*') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('dm/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/dm/perusahaan"
                                    class="nav-link {{ request()->is('dm/perusahaan') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Perusahaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/dm/departemen"
                                    class="nav-link {{ request()->is('dm/departemen') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Departemen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/dm/bagian"
                                    class="nav-link {{ request()->is('dm/bagian') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bagian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/dm/jabatan"
                                    class="nav-link nav-link {{ request()->is('dm/jabatan') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jabatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/dm/keterangan-ijin"
                                    class="nav-link {{ request()->is('dm/keterangan-ijin') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Keterangan Ijin
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/dm/jam-kerja"
                                    class="nav-link {{ request()->is('dm/jam-kerja') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jam Kerja</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('dm/mesinAbsensi') ? 'active' : '' }}">
                                <a href="{{ URL::to('/') }}/dm/mesinAbsensi" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mesin Absen</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('dm/libur') ? 'active' : '' }}">
                                <a href="{{ URL::to('/') }}/dm/libur" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hari Libur</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('dm/groupOff') ? 'active' : '' }}">
                                <a href="{{ URL::to('/') }}/dm/groupOff" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Sabtu Off</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('admin')
                    <li class="nav-item  {{ request()->is('admin/*') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ URL::to('/') }}/admin/users"
                                    class="nav-link  {{ request()->is('admin/users') ? 'active' : '' }}
                                {{ request()->is('dk/karyawan/*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Pengguna</p>
                                    <span class="right badge badge-danger">P</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
    {{-- <div class="sidebar-custom">
        <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
        <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
    </div> --}}
</aside>
