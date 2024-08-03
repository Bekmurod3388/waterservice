<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <img style="width: 90px" src="{{asset('assets/Images/logo.jpg')}}" alt="">
            <span style="text-transform: uppercase" class="app-brand-text demo menu-text fw-bolder ms-2">RGD</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @role('admin')
            @include('layouts.components.admin')
        @endrole

        @role('manager')
            @include('layouts.components.manager')
        @endrole

        @role('operator_dealer')
            @include('layouts.components.operator_dealer')
        @endrole

        @role('operator_agent')
            @include('layouts.components.operator_agent')
        @endrole

        @role('operator_cashier')
            @include('layouts.components.operator_cashier')
        @endrole
    </ul>
</aside>
<!-- / Menu -->
