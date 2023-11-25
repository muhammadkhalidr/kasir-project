@if (auth()->check())
    @if (auth()->user()->level == 1)
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="{{ url('home') }}" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-list menu-icon"></i><span class="nav-text">Orderan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('orderan') }}">Data Orderan</a></li>
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Laporan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('pengeluaran') }}">Pengeluaran</a></li>
                            <li><a href="{{ url('pembelian') }}">Pembelian</a></li>
                            <li><a href="{{ url('hutang') }}">Hutang</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Karyawan</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-people menu-icon"></i><span class="nav-text">Karyawan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('karyawan') }}">Data Karyawan</a></li>
                            <li><a href="{{ url('gaji-karyawan') }}">Gaji Karyawan</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Keuangan</li>
                    <li>
                        <a href="{{ url('keuangan') }}" aria-expanded="false">
                            <i class="icon-wallet menu-icon"></i><span class="nav-text">Data Keuangan</span>
                        </a>
                    </li>
                    <li class="nav-label">Laporan</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-doc menu-icon"></i><span class="nav-text">Data Laporan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('laporan') }}">Laporan Pengeluaran</a></li>
                            <li><a href="{{ url('laporan/pembelian') }}">Laporan Pembelian</a></li>
                            <li><a href="{{ url('laporan/gaji') }}">Laporan Gaji Karyawan</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    @elseif (auth()->user()->level == 2)
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="{{ url('home') }}" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Pengguna</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('pengguna') }}">Data Admin</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Karyawan</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-people menu-icon"></i><span class="nav-text">Karyawan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('karyawan') }}">Data Karyawan</a></li>
                            <li><a href="{{ url('gaji-karyawan') }}">Gaji Karyawan</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Keuangan</li>
                    <li>
                        <a href="{{ url('keuangan') }}" aria-expanded="false">
                            <i class="icon-wallet menu-icon"></i><span class="nav-text">Data Keuangan</span>
                        </a>
                    </li>
                    <li class="nav-label">Laporan</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-doc menu-icon"></i><span class="nav-text">Data Laporan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('laporan') }}">Laporan Pengeluaran</a></li>
                            <li><a href="{{ url('laporan/pembelian') }}">Laporan Pembelian</a></li>
                            <li><a href="{{ url('laporan/gaji') }}">Laporan Gaji Karyawan</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    @endif
@endif
