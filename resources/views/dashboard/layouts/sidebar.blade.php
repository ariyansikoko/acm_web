<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-body-secondary text-uppercase">
                <span>Main</span>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard') ? 'active' : '' }}"
                        href="/dashboard">
                        <i class="bi bi-house-fill"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/proyek') ? 'active' : '' }}"
                        href="/dashboard/proyek">
                        <i class="bi bi-graph-up-arrow"></i>Proyek
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/pengeluaran') ? 'active' : '' }}"
                        href="/dashboard/pengeluaran">
                        <i class="bi bi-cash-coin"></i>Pengeluaran
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/penerima') ? 'active' : '' }}"
                        href="/dashboard/penerima">
                        <i class="bi bi-people-fill"></i>Penerima
                    </a>
                </li>
            </ul>

            @can('admin')
                <hr class="my-3">
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-body-secondary text-uppercase">
                    <span>Administrator</span>
                </h6>
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/accounts') ? 'active' : '' }}"
                            href="/dashboard/accounts">
                            <i class="bi bi-person-circle"></i>Accounts
                        </a>
                    </li>
                </ul>
            @endcan


            <hr class="my-3">
            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-body-secondary text-uppercase">
                <span>Account</span>
            </h6>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="nav-link d-flex align-items-center gap-2">
                            <i class="bi bi-box-arrow-right"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
