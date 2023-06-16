<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVXQiXxbNsEFLa7Wo_gRz9ni3LlMlMHrPpJdb5lLSjRb-ch5-vjdgYUFN5SQYy9FKb7Gw&usqp=CAU"
                class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Controlleur</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10" style="color: #f4645f;"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Repport</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'Infractions' ? 'active' : '' }}"
                    href="{{ route('Infractions') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-sound-wave text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Infractions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'Alerts') == true ? 'active' : '' }}"
                    href="{{ route('Alerts') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Alerts</span>
                </a>
            </li>
    <!-- 
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'Accidents') == true ? 'active' : '' }}"
                    href="{{ route('Accidents') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-ambulance text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Accidents</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'Controle_Bus') == true ? 'active' : '' }}"
                    href="{{ route('Controle_Bus') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bus-front-12 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Controle Bus</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'Controle_Employer') == true ? 'active' : '' }}"
                    href="{{ route('Controle_Employer') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Controle Employer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'Declaration_perte') == true ? 'active' : '' }}"
                    href="{{ route('Declaration_perte') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-badge text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Déclaration de perte</span>
                </a>
            </li>
-->
        </ul>
    </div>

</aside>