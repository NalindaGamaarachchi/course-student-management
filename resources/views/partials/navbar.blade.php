<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand px-2" href="{{ url('/') }}">Home</a>
    <div class="collapse navbar-collapse show">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('students.index') }}">Students</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
            </li> -->
        </ul>
    </div>
    @if(auth()->check())
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @endif
</nav>