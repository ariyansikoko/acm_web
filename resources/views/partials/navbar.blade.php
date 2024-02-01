<nav class="navbar navbar-expand-lg sticky-top" style="background-color:midnightblue" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/">ACM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('/') ? 'active' : '' }}"href="/">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pengeluaran') ? 'active' : '' }}"
                            href="/pengeluaran">Pengeluaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('proyek') ? 'active' : '' }}" href="/proyek">Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('penerima') ? 'active' : '' }}" href="/penerima">Recipient</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Welcome, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" data-bs-theme="light">
                            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i>
                                    Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Log
                                        out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
