<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none"
               href="{{ route('freelancer.dashboard.home') }}">{{ trans('texts.dashboard.sidebar.dashboard') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        {{ trans('texts.dashboard.sidebar.menu') }}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @ifroute('freelancer.dashboard.home') active @endifroute"
                           href="{{ route('freelancer.dashboard.home') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            {{ trans('texts.dashboard.sidebar.dashboard') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @ifroute('freelancer.dashboard.offers') active @endifroute"
                           href="{{ route('freelancer.dashboard.offers.index') }}" data-toggle="collapse"
                           aria-expanded="false"
                           data-target="#submenu-1" aria-controls="submenu-1">
                            <i class="fas fa-stream"></i>
                            {{ trans('texts.dashboard.sidebar.jobs')  }}</a>
                        <div id="submenu-1"
                             class="submenu collapse @ifroute('freelancer.dashboard.offers') show @endifroute">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link @ifroute('freelancer.dashboard.offers.index') active @endifroute"
                                       href="{{ route('freelancer.dashboard.offers.index') }}">
                                        {{ trans('texts.dashboard.sidebar.all-jobs') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @ifroute('freelancer.dashboard.offers.applied-on') active @endifroute"
                                       href="{{ route('freelancer.dashboard.offers.applied-on') }}">
                                        {{ trans('texts.dashboard.sidebar.applied-on') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @ifroute('freelancer.dashboard.offers.in-work') active @endifroute"
                                       href="{{ route('freelancer.dashboard.offers.in-work') }}">
                                        {{ trans('texts.dashboard.sidebar.in-work') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @ifroute('freelancer.dashboard.offers.finished') active @endifroute"
                                       href="{{ route('freelancer.dashboard.offers.finished') }}">
                                        {{ trans('texts.dashboard.sidebar.finished') }}
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link"
                           target="_self"
                           href="{{ route('freelancer.auth.logout.perform') }}"
                           onclick="event.preventDefault(); document.getElementById('admin-logout-post-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ trans('texts.dashboard.sidebar.logout') }}</a>
                        <form id="admin-logout-post-form" action="{{ route('freelancer.auth.logout.perform') }}"
                              method="post"
                              style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
