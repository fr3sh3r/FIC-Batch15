<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebarlogo-brand">
            <img src="{{ asset('img/logo.png') }}" alt="logo" width="70"
                style="display: block; margin: 0 auto; /* center */
                {{-- class="shadow-light rounded-circle" --}}>
        </div>


        <div class="sidebar-brand">
            //<a href="index.html">
                <a href="home">
                    <p style="text-align:center">Klinik Sehat Bugar </p>
                </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    {{-- //awalnya seperti ini
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>
                    --}}


                    <li class=''>
                        <a class="nav-link" href="{{ route('users.index') }}">Users</a>

                    </li>

                </ul>

                <ul class="dropdown-menu">
                    <li class=''>
                        <a class="nav-link" href="{{ route('doctors.index') }}">Doctors</a>
                    </li>

                </ul>

                <ul class="dropdown-menu">
                    <li class=''>
                        <a class="nav-link" href="{{ route('doctor-schedules.index') }}">Doctors Schedules</a>
                    </li>
                </ul>

                <ul class="dropdown-menu">
                    <li class=''>
                        {{-- //menu patient --}}
                        <a class="nav-link" href="{{ route('patients.index') }}">Patients</a>
                    </li>
                </ul>


                <ul class="dropdown-menu">
                    <li class=''>
                        {{-- //menu service and medicines --}}
                        <a class="nav-link" href="{{ route('service-medicines.index') }}">Service and Medicine</a>
                    </li>
                </ul>



            </li>

    </aside>
</div>
