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
                            <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="mt-4 text-center small">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام</th>
                                            <th>توضیحات</th>
                                            <th>
                                                <?php echo anchor(route_to('admin-property-types-new'), '<span class="text">افزودن</span><i class="icon fas fa-plus"></i>', ['class' => 'btn btn-xs btn-icon-split btn-success']) ?>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>نام</th>
                                            <th>توضیحات</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php /** @var array $types */
                                        foreach ($types as $type) { ?>
                                            <tr>
                                                <td><?php echo $type['id']; ?></td>
                                                <td><?php echo $type['name']; ?></td>
                                                <td><?php echo $type['description']; ?></td>
                                                <td>
                                                    <div class="btn-toolbar">
                                                        <div role="group">
                                                            <?php echo anchor(route_to('admin-property-types-show', $type['id']), '<i class="fa fa-edit"></i>', ['class' => 'btn btn-sm btn-primary']) ?>
                                                            <?php echo anchor(route_to('admin-property-types-delete', $type['id']), '<i class="fa fa-times"></i>', ['class' => 'btn btn-sm btn-danger']) ?>
                                                        </div>
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