<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVXQiXxbNsEFLa7Wo_gRz9ni3LlMlMHrPpJdb5lLSjRb-ch5-vjdgYUFN5SQYy9FKb7Gw&usqp=CAU"
                class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">{{env('APP_NAME')}}</span>
        </a>
        
    <br>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span style="margin:65px;color:red;font-size:14px"> {{Auth::user()->username}} </span><br>
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">الرئيسية</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10" style="color: #f4645f;"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">
                    {{(Illuminate\Support\Facades\Auth::user()->id<3 || Illuminate\Support\Facades\Auth::user()->id==12)? 'Control' :((Illuminate\Support\Facades\Auth::user()->id<14)? 'Repport': 'Pannes')}}</h6>
            </li>
            @if(Illuminate\Support\Facades\Auth::user()->id>2 && Illuminate\Support\Facades\Auth::user()->id<9) <li
                class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'Infractions' ? 'active' : '' }}"
                    href="{{ route('Infractions') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-sound-wave text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">مخالفات</span>
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'Alerts') == true ? 'active' : '' }}"
                        href="{{ route('Alerts') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">تبليغات</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'Coffre') == true ? 'active' : '' }}"
                        href="{{ route('Coffre') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">مراقبة الصندوق</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'hello_world') == true ? 'active' : '' }}"
                        href="{{ route('helloworld') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">مراقبة التذاكر</span>
                    </a>
                </li>
                @elseif(Illuminate\Support\Facades\Auth::user()->id>8 && Illuminate\Support\Facades\Auth::user()->id<14 && Illuminate\Support\Facades\Auth::user()->id != 12 )

                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'Stop_bus') == true ? 'active' : '' }}"
                        href="{{ route('Panne_bus') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">توقف الحافلة</span>
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'Stop_bus') == true ? 'active' : '' }}"
                        href="{{ route('Move_bus') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">متابعة حركة الحافلات</span>
                    </a>
                </li>
                 @elseif(Illuminate\Support\Facades\Auth::user()->id>13 )

                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'ls_panne') == true ? 'active' : '' }}"
                        href="{{ route('lspannes') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">قائمة الأعطاب </span>
                    </a>
                </li>
                <li hidden class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'hello_world') == true ? 'active' : '' }}"
                        href="{{ route('helloworld') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">مرحبا</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'list_panne') == true ? 'active' : '' }}"
                        href="{{ route('lpannes') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">إضافة عطب جديد</span>
                    </a>
                </li>
                @endif
                @if(Illuminate\Support\Facades\Auth::user()->id<3 || Illuminate\Support\Facades\Auth::user()->id ==12 || Illuminate\Support\Facades\Auth::user()->id ==14)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'Control') == true ? 'active' : '' }}"
                        href="{{ route('control') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-notification-70 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Control</span>
                    </a>
                </li>
                @endif
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