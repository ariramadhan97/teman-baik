                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider my-1">

                <li class="nav-item {{ request()->is('pengaduan') ? 'active' : '' }}">
                    <a class="nav-link" href="pengaduan">
                        <i class="fas fa-edit"></i>
                        <span>Pengaduan</span></a>
                </li>

                <hr class="sidebar-divider my-1">

                <li class="nav-item {{ request()->is('manajemen-instansi') ? 'active' : '' }}">
                    <a class="nav-link" href="manajemen-instansi">
                        <i class="fas fa-city"></i>
                        <span>Manajemen Instansi</span></a>
                </li>

                <hr class="sidebar-divider my-1">

                {{-- <li class="nav-item {{ request()->is('manajemen-pengguna') ? 'active' : '' }}">
                    <a class="nav-link" href="#">
                        <i class="far fa-address-card"></i>
                        <span>Manajemen Pengguna</span></a>
                </li> --}}

                <hr class="sidebar-divider my-1">

                <li class="nav-item {{ request()->is('manajemen-pengguna') ? 'active' : '' }}">
                    <a class="nav-link px-2" href="/form">
                        <div class="bg-white text-primary rounded py-1 text-center fw-bold">
                            <i class="fa fa-list-alt text-primary"></i>
                            <span>FORM PENGADUAN</span>
                        </div>
                    </a>
                </li>


                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

                </ul>
                <!-- End of Sidebar -->
