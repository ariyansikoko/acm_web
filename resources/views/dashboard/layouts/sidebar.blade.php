<div class="sidebar border border-right col-md-2 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-body-secondary text-uppercase">
                <span>Main</span>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard') ? 'active' : 'text-secondary' }}"
                        href="/dashboard">
                        <span><i class="bi bi-house-fill"></i> Dashboard</span>
                    </a>
                </li>
                @can('user')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/proyek*') ? 'active' : 'text-secondary' }}"
                            href="/dashboard/proyek">
                            <span><i class="bi bi-cone-striped"></i> Proyek</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/pengeluaran*') ? 'active' : 'text-secondary' }}"
                            href="/dashboard/pengeluaran">
                            <span><i class="bi bi-cash-coin"></i> Pengeluaran</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/penerima*') ? 'active' : 'text-secondary' }}"
                            href="/dashboard/penerima">
                            <span><i class="bi bi-people-fill"></i> Penerima</span>
                        </a>
                    </li>
                @endcan
            </ul>
            @can('hrd')
                <hr class="my-3">
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-body-secondary text-uppercase">
                    <span>Other</span>
                </h6>
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/karyawan*') ? 'active' : 'text-secondary' }}"
                            href="/dashboard/karyawan">
                            <span><i class="bi bi-person-vcard"></i> Karyawan</span>
                        </a>
                    </li>
                </ul>
            @endcan
            @can('admin')
                <hr class="my-3">
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-body-secondary text-uppercase">
                    <span>Administrator</span>
                </h6>

                <ul class="nav flex-column mb-auto">
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/account*') ? 'active' : 'text-secondary' }}"
                            href="/dashboard/account">
                            <span><i class="bi bi-person-circle"></i> Accounts Manager</span>
                        </a>
                    </li>
                </ul>
            @endcan

            <hr class="my-3">
            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-body-secondary text-uppercase">
                <span>Settings</span>
            </h6>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="nav-link d-flex align-items-center gap-2 text-danger">
                            <span><i class="bi bi-box-arrow-right"></i> Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
