<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img style="width: 90px" src="{{asset('assets/Images/logo.jpg')}}" alt="">
            <span style="text-transform: uppercase" class="app-brand-text demo menu-text fw-bolder ms-2">RGD</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @role('admin|operator')
        <li class="menu-item @if(request()->routeIs('clients.index')) active @endif">
            <a href="{{ route('clients.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Mijozlar</div>
            </a>
        </li>
        <li class="menu-item @if(request()->routeIs('work.list')) active @endif">
            <a href="{{route('work.list')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Analytics">Ishlar ro'yxati</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Agent ishlari</div>
            </a>
        </li>
        @endrole
        @role('admin')
        <li class="menu-item @if(request()->routeIs('users.index')) active @endif">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">Foydalanuvchilar</div>
            </a>
        </li>
        <li class="menu-item @if(request()->routeIs('services.index')) active @endif">
            <a href="{{ route('services.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Servislar</div>
            </a>
        </li>

        <li class="menu-item @if(request()->routeIs('filters.index')) active @endif">
            <a href="{{ route('filters.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics"> Filterlar </div>
            </a>
        </li>
        @endrole
    </ul>
</aside>
<!-- / Menu -->
