<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    @if (request()->is('opname*'))
        @include('layouts.sections.menu.sidebar-opname')
    @elseif (request()->is('keuangan*'))
        @include('layouts.sections.menu.sidebar-finance')
    @else
        @include('layouts.sections.menu.sidebar-asset')
    @endif
</aside>