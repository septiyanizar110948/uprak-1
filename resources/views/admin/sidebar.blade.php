<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ url('index.html') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item ">
            <a class="nav-link  {{ request()->routeis('menu.create') ? 'active' : '' }}" data-bs-target="#menus-nav" data-bs-toggle="collapse"
                href="{{ url('#') }}">
                <i class="ri-admin-fill"></i><span>Menus</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menus-nav" class="nav-content {{ request()->routeis('menu') ? '' : '' }}" data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('menu.index') }}">
                        <i class="bi bi-circle"></i><span>List Menu</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

    </ul>

</aside>
