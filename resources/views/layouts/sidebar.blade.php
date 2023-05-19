{{-- ====A+P+P+K+E+Y==== --}}

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li
            class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }} {{ Route::currentRouteName() == 'profile.index' ? 'active' : '' }}">
            <a class="nav-link pl-4" href="{{ route('dashboard') }}">
                <i class="fas fa-th-large" style="width: 25px;"></i>
                <span class="menu-title font-weight-bold">@lang('default.sidenav.dashboard')</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}">
            <a class="nav-link pl-4" href="{{ route('admin.index') }}">
                <i class="fas fa-user-cog" style="width:25px"></i>
                <span class="menu-title font-weight-bold">@lang('default.sidenav.admin')</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'order.index' ? 'active' : '' }}">
            <a class="nav-link pl-4" href="{{ route('order.index') }}">
                <i class="fas fa-list-alt" style="width: 25px"></i>
                <span class="menu-title font-weight-bold">@lang('default.sidenav.data_order')</span>
            </a>
        </li>

        <li
            class="nav-item {{ Route::currentRouteName() == 'driver.index' ? 'active' : '' }} {{ Route::currentRouteName() == 'driver.track' ? 'active' : '' }}">
            <a class="nav-link pl-4 collapsed" data-toggle="collapse" href="#driver" aria-expanded="false"
                aria-controls="driver">
                <i class="fas fa-car" style="width: 25px"></i>
                <span class="menu-title font-weight-bold">@lang('default.sidenav.driver')</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Route::currentRouteName() == 'driver.index' ? 'show' : '' }} {{ Route::currentRouteName() == 'driver.track' ? 'show' : '' }}"
                id="driver" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a
                            class="nav-link font-weight-bold {{ Request::is('*/driver') ? 'active' : '' }}"
                            href="{{ route('driver.index') }}">@lang('default.sidenav.driver')</a></li>
                    <li class="nav-item"> <a
                            class="nav-link font-weight-bold {{ Request::is('*/track-driver') ? 'active' : '' }}"
                            href="{{ route('driver.track') }}">@lang('default.sidenav.driver-tracking')</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'customer.index' ? 'active' : '' }}">
            <a class="nav-link pl-4" href="{{ route('customer.index') }}">
                <i class="fas fa-user" style="width: 25px"></i>
                <span class="menu-title font-weight-bold">@lang('default.sidenav.user')</span>
            </a>
        </li>

        <li class="nav-item {{ Route::currentRouteName() == 'price-setting.index' ? 'active' : '' }}">
            <a class="nav-link pl-4" href="{{ route('price-setting.index') }}">
                <i class="fas fa-tag" style="width: 25px"></i>
                <span class="menu-title font-weight-bold">@lang('default.sidenav.price-setting')</span>
            </a>
        </li>

        <li
            class="nav-item {{ Route::currentRouteName() == 'about-us.index' || Route::currentRouteName() == 'about-us.edit' ? 'active' : '' }}">
            <a class="nav-link pl-4" href="{{ route('about-us.index') }}">
                <i class="fas fa-info-circle" style="width: 25px"></i>
                <span class="menu-title font-weight-bold">@lang('default.sidenav.about-us')</span>
            </a>
        </li>
    </ul>
</nav>
