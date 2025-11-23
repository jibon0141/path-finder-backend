

    <!-- ################################ Navbar start here ################################## -->
    <nav class="navbar uv-navbar py-0 uv-nav-bg navbar-dark sticky-top">
      <div class="container-fluid ">
        <div class="uv_navbar-left d-none d-lg-inline">
          <a class="navbar-brand d-flex align-items-center" href="#">
            <img width="fit-content" height="fit-content" src="{{asset('assets/backend_assets/assets/images/logo.svg')}}"
              class="img img-fluid me-2 ms-5 ms-md-3" alt="">
            <h5 class="fw-bold d-none d-md-block mb-0">UVIOM</h5>
          </a>
        </div>



        <div class="d-flex justify-content-between uv_navbar-right w-lg-100 align-items-center">
          <div class="d-lg-none text-white">
            <span class="sidebar-control-btn uv-nav-collapse-btn">
              <i class="fa-solid fa-align-justify"></i>
            </span>
            <span class=" sidebar-open-btn sidebar-control-btn"><i class="fa-solid fa-right-left"></i></span>
          </div>


          <div class=" text-white h-100">
            <ul class=" d-flex align-items-center mb-0 h-100">
              <li class="nav-item d-none d-lg-flex align-items-center">
                <span class="badge bg-success">Online</span>
              </li>
              <li class="d-flex d-lg-none align-items-center">
                <img width="fit-content" height="fit-content" src="{{asset('assets/backend_assets/assets/images/logo.svg')}}" width="32"
                  class="img img-fluid me-2 ms-5 ms-md-3" alt="">
                <h5 class="fw-bold d-none d-md-block mb-0">UVIOM</h5>
              </li>
            </ul>
          </div>
          <div>

            <!-- navbar items  -->
            <ul class="text-light d-flex align-items-center mb-0">
              <div class="nav-collapse-items uv-nav-collapse uv-nav-bg ">
              

              <!--########################## profile dropdown start ##################################### -->

              <li class="nav-item dropdown-center  profile-dropdown ">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="true">
                  <img width="fit-content" height="fit-content" class="avatar rounded-circle me-1" width="40px"
                    height="40px" src="{{asset('picture/admin_picture/' . Auth::guard('admins')->user()->picture)}}" alt="">
                  <span class="d-none d-lg-inline"></span>
                </a>
                <ul class="dropdown-menu dropdown-center">
                  <li><a class="dropdown-item" href="{{url('/admin/admin-profile')}}">
                      <i class="fa fa-user me-2"></i>
                      My Profile
                    </a></li>
                 

              
                  <hr class="dropdown-divider">


                  <li><a class="dropdown-item" href="#">
                      <i class="fa-solid fa-gear me-2"></i> Account setting
                    </a></li>
                  <li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-power-off me-2"></i> Logout
    </a>
</li>

                </ul>
              </li>
              <!--########################## profile dropdown end ##################################### -->


                <li class="nav-item">
                  <div class="nav-link theme-change-switch">
                    <input type="checkbox" class="theme-switch-input" id="checkbox">
                    <label for="checkbox" class="label mb-0">
                      <i class='fas fa-sun'></i>
                      <i class="fas fa-moon"></i>
                      <div class='ball' />
                    </label>
                  </div>
                </li>

            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- ################################ Navbar end here ################################## -->
  
