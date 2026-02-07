<ul class="menu-inner py-1">
    <!-- Dashboard Opname -->
    <li class="menu-item {{ request()->routeIs('opname.dashboard') ? 'active' : '' }}">
        <a href="{{ route('opname.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard Opname">Dashboard Opname</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Opname</span></li>

    <!-- Jadwal Opname (Placeholder for now) -->
    <li
        class="menu-item {{ request()->routeIs('opname.index') || request()->routeIs('opname.create') ? 'active' : '' }}">
        <a href="{{ route('opname.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-calendar"></i>
            <div data-i18n="Jadwal Opname">Jadwal Opname</div>
        </a>
    </li>

    <!-- Riwayat Opname -->
    <li class="menu-item {{ request()->routeIs('opname.history') ? 'active' : '' }}">
        <a href="{{ route('opname.history') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-history"></i>
            <div data-i18n="Riwayat">Riwayat</div>
        </a>
    </li>

    <!-- Laporan -->
    <li class="menu-item {{ request()->routeIs('opname.report') ? 'active' : '' }}">
        <a href="{{ route('opname.report') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div data-i18n="Laporan">Laporan</div>
        </a>
    </li>
</ul>