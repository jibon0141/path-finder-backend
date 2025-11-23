<div class="d-flex justify-content-between align-items-center p-2">
    <div class="d-flex gap-3 align-items-center">
        <img width="fit-content" height="fit-content" class="avatar"
             src="{{ asset('picture/admin_picture/' . Auth::guard('admins')->user()->picture) }}" alt="">

        <div class="sidebar_avatar-text  text-wrap">
            <span class="fw-600 d-block ">{{ Auth::guard('admins')->user()->name }}</span>
            <span class="text-secondary font-sm fw-600">web developer</span>
        </div>
    </div>
    <button class="btn-0 sidebar-toggle-btn d-none d-lg-inline"><i class="fa-solid fa-right-left"></i></button>
    <button class="btn-0 sidebar-close-btn d-lg-none me-2"><i class="fa-solid fa-xmark"></i></button>

</div>

<!--########################### main menu ######################################## -->
<ul class="sidebar_main-menu">
    <li class="sb_menu-heading text-secondary fw-600 font-sm my-2">
        <span>MAIN</span>
        <i class="fa-solid fa-ellipsis font-md"></i>
    </li>

    <li class="nav-item">
        <a href="{{url('/admin/dashboard')}}" class="nav-link main-nav-link  active-sidebar-item">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- starter kit  -->
    <li class="nav-item">
        <a href="#" class="nav-link main-nav-link">
            <i class="fa-solid fa-circle-check"></i>
            <span>Admin Management</span>
            <span class="sidebar-arrow">
              <i class="fa-solid fa-angle-right"></i>
            </span>
        </a>

        <ul class="sidebar_sub-menu">
            <li class="nav-item">
                <a href="#" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Manage Admin</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('/admin/admin-registration-page')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Create Admin</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

        </ul>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link main-nav-link">
            <i class="fa-solid fa-circle-check"></i>
            <span>Category Management</span>
            <span class="sidebar-arrow">
              <i class="fa-solid fa-angle-right"></i>
            </span>
        </a>

        <ul class="sidebar_sub-menu">
            <li class="nav-item">
                <a href="{{url('/manage-category')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Manage Category</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('/store-category')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Create Category</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

        </ul>
    </li>
    <!-- Category Section End -->

    <!-- Service Section Start -->
     <li class="nav-item">
        <a href="#" class="nav-link main-nav-link">
            <i class="fa-solid fa-circle-check"></i>
            <span>Service Management</span>
            <span class="sidebar-arrow">
              <i class="fa-solid fa-angle-right"></i>
            </span>
        </a>

        <ul class="sidebar_sub-menu">
            <li class="nav-item">
                <a href="{{url('/manage-service')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Manage Service</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('/store-service')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Create Service</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

        </ul>
    </li>
    <!-- Service Section End -->



        <!-- Service Section Start -->
     <li class="nav-item">
        <a href="#" class="nav-link main-nav-link">
            <i class="fa-solid fa-circle-check"></i>
            <span>Review Management</span>
            <span class="sidebar-arrow">
              <i class="fa-solid fa-angle-right"></i>
            </span>
        </a>

        <ul class="sidebar_sub-menu">
            <li class="nav-item">
                <a href="{{url('/manage-review')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Manage Review</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('/store-review')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Create Review</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

        </ul>
    </li>
    <!-- Review Section End -->

    <!-- Settings Section Start -->
    <li class="nav-item">
        <a href="#" class="nav-link main-nav-link">
            <i class="fa-solid fa-cogs"></i>
            <span>System Settings</span>
            <span class="sidebar-arrow">
              <i class="fa-solid fa-angle-right"></i>
            </span>
        </a>

        <ul class="sidebar_sub-menu">
            <li class="nav-item">
                <a href="{{url('/manage-setting')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Environment Settings</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('/system-optimization')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>System Optimization</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('/manage-logs')}}" class="nav-link sub-nav-link">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>System Logs</span>
                    <span class="sidebar-arrow">
                </span>
                </a>
            </li>

        </ul>
    </li>
    <!-- Settings Section End -->
</ul>





    