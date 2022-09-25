<?php
$custom_styles = '<link href="'.assets('admin/css/leaflet.css', false).'" rel="stylesheet"/>'.PHP_EOL;
$custom_styles .= '<link href="'.assets('admin/css/dropzone.min.css', false).'" rel="stylesheet"/>'.PHP_EOL;
$custom_styles .= '<style rel="stylesheet" type="text/css">
.mapview {
    position: relative;
    display: block;
    height: 250px;
    width: 100%;
    overflow: hidden;
}
</style>
';
$data_header   = [
    'custom_styles' => $custom_styles,
    'page_title'    => $page_title,
];

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
                                echo form_open_multipart(route_to('admin-property-update', $property['id']), ['id' => 'edit-form']); ?>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">نام </label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <?php echo form_dropdown(['id' => 'type', 'name' => 'type_id', 'placeholder' => 'نوع', 'class' => 'custom-select form-control'], $types, $property['type_id']); ?>
                                                </div>
                                                <?php echo form_input(['id' => 'name', 'name' => 'name', 'placeholder' => 'name', 'class' => 'form-control'], $property['name']); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <?php foreach ($property['meta'] as $meta) { ?>
                                                <code>
                                                    <?php echo json_encode($meta, 256); ?>
                                                </code>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="description" class="col-form-label">توضیحات</label>
                                        <?php echo form_textarea(['id' => 'description', 'rows' => 3, 'name' => 'description', 'placeholder' => 'description', 'class' => 'form-control'], $property['description']); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-sm-6">
                                        <label>موقعیت روی نقشه <span class="text-muted">به زودی</span></label>
                                        <div id="property-map" class="mapview"
                                             data-zoom="<?php echo $property['zoom']; ?>"
                                             data-latitude="<?php echo esc($property['latitude']); ?>"
                                             data-longitude="<?php echo esc($property['longitude']); ?>"></div>
                                        <?php
                                        echo form_input('zoom', $property['zoom'], ['id' => 'zoom'], 'hidden');
                                        echo form_input('latitude', $property['latitude'], ['id' => 'latitude'], 'hidden');
                                        echo form_input('longitude', $property['longitude'], ['id' => 'longitude'], 'hidden');
                                        ?>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="price" class="col-form-label">قیمت </label>
                                            <?php echo form_input(['id' => 'price', 'name' => 'price', 'class' => 'form-control', 'placeholder' => 'قیمت'], $property['price']) ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">آدرس</label>
                                            <?php echo form_input('address', $property['address'], ['id' => 'address', 'class' => 'form-control']); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="status" class="col-form-label">وضعیت </label>
                                            <?php
                                            $statuses = [
                                                'pending' => 'در دست بررسی',
                                                'publish' => 'منتشر شده',
                                                'sold'    => 'فروش رفته',
                                                '0'       => 'نامشخص',
                                            ];
                                            echo form_dropdown(['id' => 'type', 'name' => 'status', 'placeholder' => 'وضعیت', 'class' => 'form-control'], $statuses, $property['status']);
                                            //                                        echo form_input(['id' => 'status', 'name' => 'status', 'class' => 'form-control', 'placeholder' => 'قیمت'], $property['status'])
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-12">
                                        <label for="galleries">عکسهای گالری </label>
                                        <?php echo csrf_field(); ?>
                                        <div class="gallery-items dropzone"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-12">
                                        <label for="panorama">عکس پانوراما</label>
                                        <?php echo form_input(['id' => 'panorama', 'name' => 'panorama', 'type' => 'file']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-6">
                                        <?php
                                        echo form_submit('save', 'ذخیره', ['id' => 'save', 'class' => 'btn btn-lg btn-success']); ?>
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
$leafletjs = assets('admin/js/leaflet.js', false);
//$leafletjs      = 'https://unpkg.com/leaflet@1.8.0/dist/leaflet.js';
$dropzonecdn     = assets('admin/js/dropzone.min.js', false);
$lat             = $property['latitude'];
$lon             = $property['longitude'];
$zoom            = $property['zoom'];
$id              = $property['id'];
$custom_scripts  = '<script src="'.$leafletjs.'"></script>';
$custom_scripts  .= '<script src="'.$dropzonecdn.'"></script>';
$upload_url      = route_to('admin-property-update', $property['id']);
$list_url        = route_to('admin-property-gallery-items', $property['id']);
$panorama_upload = '';
$custom_scripts  .= <<<CUSTOM_SCRIPTS
<script>
   Dropzone.autoDiscover = false;

   var myDropzone = new Dropzone(".gallery-items",{
       url : "$upload_url",
       autoProcessQueue: false,
       autoDiscover: false,
       maxFilesize: 10, // 10 mb
       // parallelUploads : 10,
       acceptedFiles: ".jpeg,.jpg,.png",
       init : function (){
           let myDropzone = this;
            $.ajax({
                type: 'get',
                url: "$list_url",
                success: function(mocks){
                    // console.log(mocks);
                    $.each(mocks, function(key,value) {
                        let mockFile = { name: value.name, size: value.size };
                        // console.log(mockFile);
                        myDropzone.displayExistingFile(mockFile, value.file_url);
                    });
                },
                error: function(xhr, durum, hata) {
                    alert("we get error on getting list of uploaded files: " + hata);
                }
            });
           // console.log('test')
           $('#edit-form').on('submit',function(e){
               e.preventDefault()
               myDropzone.processQueue()
           })
      }
   }).on('processing',function(){
       myDropzone.options.autoProcessQueue = true;
   })
   .on("sending", function(file, xhr, formData) {
       var form_data = $('#edit-form').serializeArray();
       formData.append('property_id',$id)
       $.each(form_data, function(key, el) {
            formData.append(el.name, el.value)
       });
   })
   .on("queuecomplete", function(file) {
       // let gallery_images = $('#gallery_images').val(JSON.stringify(response.data));
       // alert(response.message);
       console.log('queuecomplete')
       // window.location.reload();
   });
   
//   var panoramaDropzone = new Dropzone('#panorama',{
//       url: "$panorama_upload",
//       maxFilesize: 10, // 10 mb
//       acceptedFiles: ".jpeg,.jpg,.png",
//       init : function (){
//           console.log("$panorama_upload")
//           let myDropzone = this;
//            $.ajax({
//                type: 'get',
//                url: "$list_url",
//                success: function(mocks){
//                    // console.log(mocks);
//                    $.each(mocks, function(key,value) {
//                        let mockFile = { name: value.name, size: value.size };
//                        // console.log(mockFile);
//                        myDropzone.displayExistingFile(mockFile, value.file_url);
//                    });
//                },
//                error: function(xhr, durum, hata) {
//                    alert("Hata: " + hata);
//                }
//            });
//           console.log('test')
//      }
//   })
   
   </script>
<script>
function main() {
    var lat = $('#latitude').val();
    var lon = $('#longitude').val();
    var zoom_level = $('#zoom').val();
    var options = {
        center: [lat, lon],
        zoom: zoom_level
    }
    
    var map = L.map('property-map', options);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution: 'Ali Qorbani'})
    .addTo(map);

    let icon_marker = L.marker([lat, lon]).addTo(map);

    map.on('click', function(e){
            let lat = e.latlng.lat,
                lng = e.latlng.lng,
                new_location = L.latLng(lat,lng) 
            map.setView(new_location);
            icon_marker.setLatLng(new_location);
            $('#latitude').val(lat);
            $('#longitude').val(lng);
            let z = map.getZoom();
            $('#zoom').val(z);
        });
}
window.onload = main;
</script>
CUSTOM_SCRIPTS;
echo view('admin/includes/footer', ['custom_scripts' => $custom_scripts]);
//die(); ?>