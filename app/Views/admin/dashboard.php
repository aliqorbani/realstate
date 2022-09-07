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
                <?php echo view('admin/dashboard/cards'); ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
<?php
echo view('admin/includes/footer'); die(); ?>