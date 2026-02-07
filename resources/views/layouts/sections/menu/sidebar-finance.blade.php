<ul class="menu-inner py-1">
    <!-- Dashboard Finance -->
    <li class="menu-item {{ request()->routeIs('finance.dashboard') ? 'active' : '' }}">
        <a href="{{ route('finance.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard Keuangan">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Input Data</span></li>

    <li class="menu-item {{ request()->routeIs('finance.accounts.*') ? 'active' : '' }}">
        <a href="{{ route('finance.accounts.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-list-ul"></i>
            <div data-i18n="Daftar Akun">Daftar Akun</div>
        </a>
    </li>

    <li class="menu-item {{ request()->routeIs('finance.transactions.*') ? 'active' : '' }}">
        <a href="{{ route('finance.transactions.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-notepad"></i>
            <div data-i18n="Jurnal Umum">Jurnal Umum</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Laporan</span></li>

    <li class="menu-item {{ request()->routeIs('finance.trial-balance') ? 'active' : '' }}">
        <a href="{{ route('finance.trial-balance') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-table"></i>
            <div data-i18n="Neraca Saldo">Neraca Saldo</div>
        </a>
    </li>

    <li class="menu-item {{ request()->routeIs('finance.general-ledger') ? 'active' : '' }}">
        <a href="{{ route('finance.general-ledger') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div data-i18n="Buku Besar">Buku Besar</div>
        </a>
    </li>

    <li class="menu-item {{ request()->routeIs('finance.profit-loss') ? 'active' : '' }}">
        <a href="{{ route('finance.profit-loss') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-bar-chart"></i>
            <div data-i18n="Laba Rugi">Laba Rugi</div>
        </a>
    </li>
</ul>