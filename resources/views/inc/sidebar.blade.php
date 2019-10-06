<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/timetable">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Lessons</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="/exam">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Exams</span>
            </a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudent" aria-expanded="true" aria-controls="collapseStudent">
              <i class="fas fa-fw fa-cog"></i>
              <span>Pupils</span>
            </a>
            <div id="collapseStudent" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">puplis</h6>
                <a class="collapse-item" href="/student">Student</a>
                @cannot('isTeacher')
                    <a class="collapse-item" href="/student/create">Add New Student</a>
                @endcannot
              </div>
            </div>
        </li>
        @can('isAdmin')
            <li class="nav-item">
                <a class="nav-link" href="/teacher">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Users</span>
                </a>
            </li>
        @endcan


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Other Utilities
        </div>
         <!-- Nav Item - Pages Collapse Menu -->

         <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinance" aria-expanded="true" aria-controls="collapseFinance">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Finances</span>
                </a>
                <div id="collapseFinance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">finances</h6>
                    <a class="collapse-item" href="/finance">Account</a>
                    @cannot('isTeacher')
                        <a class="collapse-item" href="/fees">Fees</a>
                     @endcannot
                  </div>
                </div>
            </li>

        <!-- Nav Item - Pages Collapse Menu -->
        @can('isAdmin')
            <li class="nav-item">
                <a class="nav-link" href="/library">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Library</span>
                </a>
            </li>
        @endcan

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Assets</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">School assets:</h6>
              <a class="collapse-item" href="#">Trasport</a>
              <a class="collapse-item" href="#">Academic</a>
              <a class="collapse-item" href="#">Kitchen</a>
              <a class="collapse-item" href="#">Boarding</a>
              <a class="collapse-item" href="#">Adminstration</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
      <!-- End of Sidebar -->
