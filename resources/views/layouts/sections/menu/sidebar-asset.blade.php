<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <!-- Asset Management -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Assets</span></li>
    <li class="menu-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
        <a href="{{ route('categories.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-category"></i>
            <div data-i18n="Categories">Kategori</div>
        </a>
    </li>
    <li class="menu-item {{ request()->routeIs('assets.*') ? 'active' : '' }}">
        <a href="{{ route('assets.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-box"></i>
            <div data-i18n="Asset List">Daftar Aset</div>
        </a>
    </li>
</ul>