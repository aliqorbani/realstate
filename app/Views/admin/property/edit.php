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
                                echo form_open(route_to('admin-property-update', $property['id'])); ?>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <label for="name" class="col-form-label">نام </label>
                                        <?php echo form_input(['id' => 'name', 'name' => 'name', 'placeholder' => 'name', 'class' => 'form-control'], $property['name']); ?>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label for="type" class="col-form-label">نوع</label>
                                        <?php
                                        $types_options = [];
                                        foreach ($types as $type) {
                                            $types_options[$type['id']] = $type['name'];
                                        }
                                        echo form_dropdown(['id' => 'type', 'name' => 'type_id', 'placeholder' => 'نوع', 'class' => 'form-control'], $types_options, $property['type_id']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="description" class="col-form-label">توضیحات</label>
                                        <?php echo form_textarea(['id' => 'description', 'rows' => 3, 'name' => 'description', 'placeholder' => 'description', 'class' => 'form-control'], $property['description']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <label for="price" class="col-form-label">قیمت </label>
                                        <?php echo form_input(['id' => 'price', 'name' => 'price', 'class' => 'form-control', 'placeholder' => 'قیمت'], $property['price']) ?>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label for="status" class="col-form-label">وضعیت </label>
                                        <?php
                                        $statuses = [
                                            'pending' => 'در دست بررسی',
                                            'publish' => 'منتشر شده',
                                            'sold'    => 'فروش رفته',
                                            '0'       => 'نامشخص',
                                        ];
                                        echo form_dropdown(['id' => 'type', 'name' => 'status', 'placeholder' => 'نوع', 'class' => 'form-control'], $statuses, $property['status']);
                                        //                                        echo form_input(['id' => 'status', 'name' => 'status', 'class' => 'form-control', 'placeholder' => 'قیمت'], $property['status'])
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <label for="galleries">موقعیت روی نقشه <span class="text-muted">به زودی</span></label>
                                        <div id="mapdiv" data-latitude="<?php echo esc($property['latitude']); ?>" data-longitude="<?php echo esc($property['longitude']); ?>" style="width: 100%; min-height: 400px;background: lightblue"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <label for="galleries">عکسهای گالری <span class="text-muted">به زودی</span></label>
                                        <?php echo form_input(['id' => 'galleries', 'name' => 'galleries', 'type' => 'file', 'disabled' => true]); ?>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label for="panorama">عکس پانوراما <span class="text-muted">به زودی</span></label>
                                        <?php echo form_input(['id' => 'panorama', 'name' => 'panorama', 'type' => 'file', 'disabled' => true]); ?>
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