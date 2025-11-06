<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html"
            target="_blank">
            <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">ReFilms</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-gradient-primary text-white' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- SVG dashboard --}}
                        <svg width="12px" height="12px" viewBox="0 0 45 40" xmlns="http://www.w3.org/2000/svg">
                            <title>shop</title>
                            <g fill="#FFFFFF">
                                <path class="color-background opacity-6"
                                    d="M46.7,10.74 L40.84,0.95 C40.49,0.36 39.85,0 39.17,0 L7.83,0 C7.15,0 6.51,0.36 6.16,0.95 L0.28,10.74 C0.1,11.05 0,11.39 0,11.75 C-0.01,16.07 3.48,19.57 7.8,19.58 C9.75,19.59 11.62,18.87 13.05,17.58 C16.02,20.26 20.53,20.26 23.49,17.58 C26.46,20.26 30.98,20.26 33.95,17.58 C36.24,19.65 39.54,20.17 42.37,18.91 C45.19,17.65 47.01,14.84 47,11.75 C47,11.39 46.9,11.05 46.7,10.74 Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('film.*') ? 'active bg-gradient-primary text-white' : '' }}"
                    href="{{ route('film.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- SVG film --}}
                        <svg width="12px" height="12px" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">
                            <title>office</title>
                            <g fill="#FFFFFF">
                                <path class="color-background opacity-6"
                                    d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78 9.53,0 10.5,0 L31.5,0 C32.47,0 33.25,0.78 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Film</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('genre.*') ? 'active bg-gradient-primary text-white' : '' }}"
                    href="{{ route('genre.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- SVG genre --}}
                        <svg width="12px" height="12px" viewBox="0 0 43 36" xmlns="http://www.w3.org/2000/svg">
                            <title>credit-card</title>
                            <g fill="#FFFFFF">
                                <path class="color-background opacity-6"
                                    d="M43,10.75 L43,3.58 C43,1.6 41.4,0 39.42,0 L3.58,0 C1.6,0 0,1.6 0,3.58 L0,10.75 L43,10.75 Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Genre</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('negara.*') ? 'active bg-gradient-primary text-white' : '' }}"
                    href="{{ route('negara.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- SVG negara --}}
                        <svg width="12px" height="12px" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">
                            <title>box-3d</title>
                            <g fill="#FFFFFF">
                                <path class="color-background"
                                    d="M22.76,19.31 L38.9,11.24 C39.39,10.99 39.59,10.39 39.35,9.9 L20.27,0.14 C19.91,-0.05 19.47,-0.05 19.1,0.14 L3.1,8.14 C2.61,8.39 2.41,8.99 2.65,9.48 L21.86,19.31 C22.15,19.45 22.48,19.45 22.76,19.31 Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Negara</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('highlight.*') ? 'active bg-gradient-primary text-white' : '' }}"
                    href="{{ route('highlight.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- SVG highlight --}}
                        <svg width="12px" height="12px" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg">
                            <title>box-3d</title>
                            <g fill="#FFFFFF">
                                <path class="color-background"
                                    d="M22.76,19.31 L38.9,11.24 C39.39,10.99 39.59,10.39 39.35,9.9 L20.27,0.14 C19.91,-0.05 19.47,-0.05 19.1,0.14 L3.1,8.14 C2.61,8.39 2.41,8.99 2.65,9.48 L21.86,19.31 C22.15,19.45 22.48,19.45 22.76,19.31 Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Highlight</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
            <div class="full-background" style="background-image: url('../assets/img/curved-images/white-curved.jpeg')">
            </div>
            <div class="card-body text-start p-3 w-100">
                <div
                    class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                    <i class="ni ni-diamond text-dark text-gradient text-lg top-0" aria-hidden="true"
                        id="sidenavCardIcon"></i>
                </div>
                <div class="docs-info">
                    <h6 class="text-white up mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold">Please check our docs</p>
                    <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard"
                        target="_blank" class="btn btn-white btn-sm w-100 mb-0">Documentation</a>
                </div>
            </div>
        </div>
        <a class="btn bg-gradient-primary mt-4 w-100"
            href="https://www.creative-tim.com/product/soft-ui-dashboard-pro?ref=sidebarfree" type="button">Upgrade to
            pro</a>
    </div>
</aside>
