<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo route_to('dashboard'); ?>">
            <span class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </span>
        <span class="sidebar-brand-text mx-3">dashboard</span>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo (trim(current_url(),'/') == site_url(route_to('admin-dashboard'))) ? 'active' : '' ?>">
        <a class="nav-link" href="<?php echo route_to('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>داشبورد</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        مستقلات
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>لیست کلی مستقلات</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">مستقلات</h6>
                <a class="collapse-item" href="<?php echo route_to('admin-property-index') ?>">لیست کلی</a>
                <a class="collapse-item" href="<?php echo route_to('admin-property-new') ?>">افزودن جدید</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTypes"
           aria-expanded="true" aria-controls="collapseTypes">
            <i class="fas fa-fw fa-cog"></i>
            <span>انواع مستقلات</span>
        </a>
        <div id="collapseTypes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">انواع مستقلات</h6>
                <a class="collapse-item" href="<?php echo route_to('admin-property-types-index') ?>">لیست کلی</a>
                <a class="collapse-item" href="<?php echo route_to('admin-property-types-new') ?>">افزودن</a>
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