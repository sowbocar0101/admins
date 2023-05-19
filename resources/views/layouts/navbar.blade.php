{{-- ====A+P+P+K+E+Y==== --}}

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5 font-weight-bold" style="color: #08588B"
            href="{{ route('dashboard') }}">@lang('default.app_name')</a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><b>M</b></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="ti-layout-grid2 new-text-aqua-color"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="index.html#" data-toggle="dropdown" id="profileDropdown">
                    {{-- @if (Config::get('app.locale') == 'id')
                        <img src="{{ asset('images/indonesia.svg') }}" alt="" srcset=""
                            style="width: 30px;border-radius: 0px;">
                    @elseif (Config::get('app.locale') == 'en')
                        <img src="{{ asset('images/united-kingdom.svg') }}" alt="" srcset=""
                            style="width: 30px;border-radius: 0px;">
                    @elseif (Config::get('app.locale') == 'jp')
                        <img src="{{ asset('images/japan.svg') }}" alt="" srcset=""
                            style="width: 30px;border-radius: 0px;">
                    @endif --}}
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown"
                    style="min-width: 1em;">
                    @if (Config::get('app.locale') == 'id')
                        <a class="dropdown-item" href="switch=jp" style="padding: 0px 1.562rem;"><img
                                src="{{ asset('images/japan.svg') }}" alt="" srcset=""
                                style="width: 30px;border-radius: 0px;"></a>
                        <a class="dropdown-item" href="switch=en" style="padding: 0px 1.562rem;"><img
                                src="{{ asset('images/united-kingdom.svg') }}" alt="" srcset=""
                                style="width: 30px;border-radius: 0px;"></a>
                    @elseif (Config::get('app.locale') == 'en')
                        <a class="dropdown-item" href="switch=jp" style="padding: 0px 1.562rem;"><img
                                src="{{ asset('images/japan.svg') }}" alt="" srcset=""
                                style="width: 30px;border-radius: 0px;"></a>
                        <a class="dropdown-item" href="switch=id" style="padding: 0px 1.562rem;"><img
                                src="{{ asset('images/indonesia.svg') }}" alt="" srcset=""
                                style="width: 30px;border-radius: 0px;"></a>
                    @elseif (Config::get('app.locale') == 'jp')
                        <a class="dropdown-item" href="switch=id" style="padding: 0px 1.562rem;"><img
                                src="{{ asset('images/indonesia.svg') }}" alt="" srcset=""
                                style="width: 30px;border-radius: 0px;"></a>
                        <a class="dropdown-item" href="switch=en" style="padding: 0px 1.562rem;"><img
                                src="{{ asset('images/united-kingdom.svg') }}" alt="" srcset=""
                                style="width: 30px;border-radius: 0px;"></a>
                    @endif
                </div>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="index.html#" data-toggle="dropdown" id="profileDropdown">
                    <img src="{{ asset('images/user-male.jpg') }}" alt="profile" /> &nbsp; {{ session('name') }}
                    &nbsp; <i class="fas fa-angle-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href=""
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="{{ asset('icon/logout.svg') }}" class="pr-2" style="width:25px;">
                        @lang('default.new.logout')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        <img src="{{ asset('icon/edit.svg') }}" class="pr-2" style="width:25px;">
                        @lang('default.new.profile.edit')
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="ti-layout-grid2"></span>
        </button>
    </div>
</nav>
