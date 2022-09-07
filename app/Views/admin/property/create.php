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

                                <?php
                                helper('form');
                                echo form_open(route_to('admin-property-types-store')); ?>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-12 col-form-label">نام </label>
                                    <div class="col-12 col-sm-6">
                                        <?php echo form_input(['id' => 'name', 'name' => 'name', 'placeholder' => 'name', 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-12 col-form-label">توضیحات</label>
                                    <div class="col-12 col-sm-6">
                                        <?php echo form_textarea(['id' => 'description', 'rows' => 3, 'name' => 'description', 'placeholder' => 'description', 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <?php echo form_submit('save', 'ذخیره', ['id' => 'save', 'class' => 'btn btn-lg btn-success']); ?>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>

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