
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<header class="bg-primary text-white py-2 mb-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h3 class="m-0 fw-bold">Student Management</h3>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-white fs-5" href="{{ route('student.list') }}">Student Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-5" href="{{ route('classes.index') }}">Class</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-5" href="{{ route('subjects.index') }}">Subject</a>
                </li>
                <li class="nav-item dropdown">
                    <!-- User Icon as Dropdown Trigger -->
                    <a class="nav-link dropdown-toggle d-flex align-items-center fs-5 text-white" href="#"
                        id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i> <!-- User icon -->
                    </a>
                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- Optional: Add more user links here -->
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</header>