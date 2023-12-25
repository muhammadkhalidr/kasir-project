@if (auth()->check())
    @if (auth()->user()->level == 1)
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Data Master</li>
                    <li>
                        <a href="{{ url('home') }}" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-basket menu-icon"></i><span class="nav-text">Transaksi</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('orderan') }}">Data Transaksi</a></li>
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
                            <li><a href="{{ url('pendapatan') }}">Rincian Pendapatan</a></li>
                            <li><a href="{{ url('piutang') }}">Rincian Piutang</a></li>
                            <li><a href="{{ url('aktifitas') }}">Log Transaksi</a></li>
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
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-wallet menu-icon"></i><span class="nav-text">Data Keuangan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('keuangan') }}">Log Keuangan</a></li>
                            <li><a href="{{ url('kas') }}">Data Kas</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Pelanggan</li>
                    <li>
                        <a href="{{ url('pelanggan') }}" aria-expanded="false">
                            <i class="icon-user-follow menu-icon"></i><span class="nav-text">Data Pelanggan</span>
                        </a>
                    </li>
                    <li class="nav-label">Pengaturan</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-settings menu-icon"></i><span class="nav-text">Pengaturan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('setting') }}">Aplikasi</a></li>
                            <li><a href="{{ url('rekening') }}">Rekening</a></li>
                        </ul>
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
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-wallet menu-icon"></i><span class="nav-text">Data Keuangan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('keuangan') }}">Log Keuangan</a></li>
                            <li><a href="{{ url('kas') }}">Data Kas</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Pelanggan</li>
                    <li>
                        <a href="{{ url('pelanggan') }}" aria-expanded="false">
                            <i class="icon-wallet people-icon"></i><span class="nav-text">Data Pelanggan</span>
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
    @elseif (auth()->user()->level == 3)
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-basket menu-icon"></i><span class="nav-text">Transaksi</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('orderan') }}">Data Transaksi</a></li>
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
                            <li><a href="{{ url('pendapatan') }}">Rincian Pendapatan</a></li>
                            <li><a href="{{ url('piutang') }}">Rincian Piutang</a></li>
                            <li><a href="{{ url('aktifitas') }}">Log Transaksi</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Keuangan</li>
                    <li>
                        <a href="{{ url('kas') }}" aria-expanded="false">
                            <i class="icon-wallet menu-icon"></i><span class="nav-text">Kas</span>
                        </a>
                    </li>
                    <li class="nav-label">Pelanggan</li>
                    <li>
                        <a href="{{ url('pelanggan') }}" aria-expanded="false">
                            <i class="icon-wallet people-icon"></i><span class="nav-text">Data Pelanggan</span>
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
