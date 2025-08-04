<!--
=========================================================
 Light Bootstrap Dashboard - Laravel Layout (cleaned)
=========================================================

 Based on Creative Tim template – stripped down for Blade.
=========================================================
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Icons / favicons you already copied to public/assets/ --}}
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.ico">

    {{-- Google font & Font‑Awesome (optional) --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    {{-- Vite‑bundled assets (Bootstrap + LBD CSS & JS) --}}
      @vite([
      'resources/scss/dashboard.scss',
      'resources/js/dashboard.js',
    ])

    {{-- Custom styles --}}
</head>
<body>
<div class="wrapper">
    {{-- ▸ Sidebar --}}
    <div class="sidebar" data-image="/assets/img/sidebar-5.jpg">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="https://www.creative-tim.com" class="simple-text">Creative Tim</a>
            </div>
            <ul class="nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="nc-icon nc-chart-pie-35"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- User sidebar --}}
                <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="material-icons">...</i>
                        <p>Users</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    {{-- ▸ Main panel --}}
    <div class="main-panel">
        {{-- Top Navbar --}}
        <nav class="navbar navbar-expand-lg" color-on-scroll="500">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Dashboard</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    {{-- right‑side nav items, dropdowns …  --}}
                    <ul class="navbar-nav ml-auto">

                        {{-- Logout button --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
                <a
                    href="#"
                    class="btn btn-outline-secondary ml-3"
                    style="font-size: 1rem; padding: 0.5rem 1rem;"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                    Log out
                        </a>

                    </ul>
                </div>
            </div>
        </nav>

        {{-- ▸ Dynamic page content injected here --}}
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        {{-- Footer --}}
        <footer class="footer">
            <div class="container-fluid text-center">
                © <script>document.write(new Date().getFullYear())</script>
                <a href="https://www.creative-tim.com">Creative&nbsp;Tim</a>
            </div>
        </footer>
    </div> {{-- /main‑panel --}}
</div> {{-- /wrapper --}}
</body>
</html>
