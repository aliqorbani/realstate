<?php
$data_header['page_title'] = $page_title;
echo view('admin/includes/header', $data_header);
echo view('admin/includes/sidebar', ['active_submenu' => '']); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php echo view('admin/includes/topbar', []); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?php echo $page_title; ?></h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-12 mb-4">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="mt-4 text-right small">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام</th>
                                            <th>نوع</th>
                                            <th>آدرس</th>
                                            <th>قیمت</th>
                                            <th>
                                                <?php echo anchor(route_to('admin-property-new'), '<span class="text">افزودن</span><i class="icon fas fa-plus"></i>', ['class' => 'btn btn-xs btn-icon-split btn-success']) ?>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>نام</th>
                                            <th>نوع</th>
                                            <th>آدرس</th>
                                            <th>قیمت</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php /** @var array $properties */
                                        foreach ($properties as $property) { ?>
                                            <tr>
                                                <td><?php echo $property['id']; ?></td>
                                                <td><?php echo $property['name']; ?></td>
                                                <td><?php echo $property['type_name']; ?></td>
                                                <td><?php echo $property['address']; ?></td>
                                                <td><?php echo $property['price']; ?></td>
                                                <td>
                                                    <div class="btn-toolbar">
                                                        <div role="group">
                                                            <?php echo anchor(route_to('single-property', $property['id']), '<i class="fa fa-eye"></i>', ['class' => 'btn btn-sm btn-success', 'target' => '_blank']) ?>
                                                            <?php echo anchor(route_to('admin-property-show', $property['id']), '<i class="fa fa-edit"></i>', ['class' => 'btn btn-sm btn-primary']) ?>
                                                            <?php echo anchor(route_to('admin-property-delete', $property['id']), '<i class="fa fa-times"></i>', ['class' => 'btn btn-sm btn-danger']) ?>
                                                        </div>
                                                        <?php
                                                        $status = property_persian_status($property['status']);
                                                        ?>
                                                        <span class="mr-auto btn btn-sm btn-<?php echo $status['class']; ?>"><?php echo $status['name']; ?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
<?php
echo view('admin/includes/footer');
die(); ?>