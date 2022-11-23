<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand" target="_blank" href="{{route('dashboard')}}">
            <strong style="color: rgb(5, 5, 67);">Gweru Exhibition</strong>
        </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
            aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Auth::user()->hasRole('user'))
                    <li class="nav-item active">
                        <a class="nav-link" href="">Membership</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('user-exhibit')}}">Exhibition</a>
                    </li>
                @endif
            </ul>

            <ul class="navbar-nav d-flex flex-row">
                <!-- Icons -->
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="">
                        <i class="bi bi-person"></i>
                        <em>{{Auth::user()->name}}</em>
                    </a>
                </li>

                <li class="nav-item me-3 me-lg-0 ml-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger rounded-pill btn-sm" type="submit">
                            <i class="bi bi-lock"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
