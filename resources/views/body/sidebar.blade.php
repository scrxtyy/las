<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" target="_blank">
            <img src="{{ asset('storage/assets/img/install.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Leave Application System</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(auth()->check() && (auth()->user()->usertype === 'Super-Admin' || auth()->user()->usertype === 'admin'))
                <li class="nav-item">
                    <a class="nav-link  active" href="{{ route('admin.dashboard') }}">
                        <div class="border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-building"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if(auth()->check() && (auth()->user()->usertype === 'employee'))
                <li class="nav-item">
                    <a class="nav-link  active" href="{{ route('employee.dashboard') }}">
                        <div class="border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-building"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            @if(auth()->check() && (auth()->user()->usertype === 'Super-Admin' || auth()->user()->usertype === 'admin'))
                <li class="nav-item">
                    <a class="nav-link  active" href="{{ route('users') }}">
                        <div class="border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02"></i>
                        </div>
                        <span class="nav-link-text ms-1">Employee List</span>
                    </a>
                </li>
            @endif
            @if(auth()->check() && (auth()->user()->usertype === 'employee'))
                <li class="nav-item">
                    <a class="nav-link  active" href="{{ route('apply') }}">
                        <div class="border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04"></i>
                        </div>
                        <span class="nav-link-text ms-1">Apply for Leave</span>
                    </a>
                </li>
            @endif
                <li class="nav-item">
                    <a class="nav-link  active" href="{{ route('logout') }}">
                        <div class="border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-button-power"></i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                </li>
        </ul>
    </div>
</aside>