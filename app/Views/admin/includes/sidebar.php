<?php

$current_url     = current_url();
$uri             = current_url(true);
$segments        = $uri->getSegments();
$id              = $segments[3] ?? 0;
$dashboard_links = [
    site_url(route_to('admin-dashboard')),
];

$property_active_links = [
    site_url(route_to('admin-property-index')),
    site_url(route_to('admin-property-new')),
];
$type_active_links     = [
    site_url(route_to('admin-property-types-index')),
    site_url(route_to('admin-property-types-new')),
];

$is_type     = (is_numeric($id) && url_is(route_to('admin-property-types-show', $id)));
$is_property = (is_numeric($id) && url_is(route_to('admin-property-show', $id)));

?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo route_to('admin-dashboard'); ?>">
            <span class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </span>
        <span class="sidebar-brand-text mx-3">داشبورد</span>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo in_array($current_url, $dashboard_links) ? 'active' : '' ?>">
        <a class="nav-link" href="<?php echo route_to('admin-dashboard'); ?>">
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

    <li class="nav-item <?php echo ($is_property || in_array($current_url, $property_active_links)) ? 'active' : '' ?>">
        <a class="nav-link <?php echo ( ! $is_property || ! in_array($current_url, $property_active_links)) ? 'collapsed' : ''; ?>" href="#" data-toggle="collapse" data-target="#collapse1"
           aria-expanded="true" aria-controls="collapse1">
            <i class="fas fa-fw fa-cog"></i>
            <span>لیست کلی مستقلات</span>
        </a>
        <div id="collapse1" class="collapse <?php echo ($is_property || in_array($current_url, $property_active_links)) ? 'show' : ''; ?>" aria-labelledby="heading1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 id="heading1" class="collapse-header">مستقلات</h6>
                <a class="collapse-item <?php echo url_is(route_to('admin-property-index')) ? 'active' : ''; ?>" href="<?php echo route_to('admin-property-index') ?>">لیست کلی</a>
                <a class="collapse-item <?php echo url_is(route_to('admin-property-new')) ? 'active' : ''; ?>" href="<?php echo route_to('admin-property-new') ?>">افزودن جدید</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php echo ($is_type || in_array($current_url, $type_active_links)) ? 'active' : '' ?>">
        <a class="nav-link <?php echo ( ! $is_type || ! in_array($current_url, $type_active_links)) ? 'collapsed' : ''; ?>" href="#" data-toggle="collapse" data-target="#collapse2"
           aria-expanded="true" aria-controls="collapse2">
            <i class="fas fa-fw fa-cog"></i>
            <span>انواع مستقلات</span>
        </a>
        <div id="collapse2" class="collapse <?php echo $is_type || in_array($current_url, $type_active_links) ? 'show' : ''; ?>" aria-labelledby="heading1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">مستقلات</h6>
                <a class="collapse-item <?php echo url_is(route_to('admin-property-types-index')) ? 'active' : ''; ?>" href="<?php echo route_to('admin-property-types-index') ?>">لیست کلی</a>
                <a class="collapse-item <?php echo url_is(route_to('admin-property-types-new')) ? 'active' : ''; ?>" href="<?php echo route_to('admin-property-types-new') ?>">افزودن جدید</a>
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