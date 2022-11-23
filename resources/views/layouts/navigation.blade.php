<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link " href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-exhibitors')}}">
                    <i class="bi bi-credit-card"></i>
                    <span>Exhibition</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-members')}}">
                    <i class="bi bi-people"></i>
                    <span>Members</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-transactions')}}">
                    <i class="bi bi-coin"></i>
                    <span>Transactions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-notices')}}">
                    <i class="bi bi-chat"></i>
                    <span>Notices</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-votes')}}">
                    <i class="bi bi-chat"></i>
                    <span>Votes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin-users') }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>
        @elseif (Auth::user()->hasRole('exhibitor'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('exhibitor-products') }}">
                    <i class="bi bi-coin"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('exhibitor-transactions') }}">
                    <i class="bi bi-coin"></i>
                    <span>Transactions</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="bi bi-lock"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Blank Page Nav -->
    </ul>
</aside>
