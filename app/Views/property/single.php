<?php
/** @var array $property */
?><!doctype html>
<html lang="en">
<head>
    <title><?php document_title($property['name']); ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php assets('front/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php assets('front/css/fotorama.css'); ?>">
    <link rel="stylesheet" href="<?php echo esc('http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css'); ?>"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo route_to('front-page') ?>">Property List</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo route_to('admin-dashboard') ?>">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container py-5">
    <h1 class="font-weight-bold border-bottom border-bottom-dark mb-3">مشخصات <?php echo $property['type_name'].' '.$property['name']; ?></h1>
    <div class="row">
        <div class="col-12 col-sm-4 sidebar sticky-sm-top">
            <div class="card bg-white card-has-ribbon">
                <div class="ribbon ribbon-<?php echo $property['status']; ?>"><span><?php echo $property['status']; ?></span></div>
                <div class="card-body">
                    <?php echo sprintf('<span class="font-monospace amount">%1$s</span> %2$s', format_number($property['price']), 'تومان'); ?>
                </div>
                <ul class="pt-2 list-unstyled list-group list-group-flush">
                    <?php
                    foreach ($property['meta'] as $mk => $meta) {
                        if ($mk > 3) {
                            continue;
                        }
                        echo '<li class="list-group-item small d-flex justify-content-between '.$meta['meta_key'].'"><span class="meta-title">'.$meta['meta_title'].'</span> <span class="bg-secondary badge meta-value">'.$meta['meta_value'].'</span></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-8 content">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery-content" type="button" role="tab" aria-controls="gallery-content" aria-selected="true">گالری</button>
                    <button class="nav-link" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-content" type="button" role="tab" aria-controls="description-content" aria-selected="false">توضیحات</button>
                    <button class="nav-link" id="mapview-tab" data-bs-toggle="tab" data-bs-target="#mapview-content" type="button" role="tab" aria-controls="mapview-content" aria-selected="false">نمایش موقعیت روی نقشه</button>
                    <button class="nav-link" id="panorama-tab" data-bs-toggle="tab" data-bs-target="#panorama-content" type="button" role="tab" aria-controls="panorama-content" aria-selected="false">عکس پانوراما</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="gallery-content" role="tabpanel" aria-labelledby="gallery-tab">
                    <div class="fotorama"
                         data-nav="thumbs"
                         data-transition="slide"
                         data-fit="contain"
                         data-allowfullscreen="true"
                         data-maxheight="470"
                         data-width="100%"
                         data-thumbheight="75px"
                         data-thumbwidth="100px"
                         data-max-width="100%">
                        <?php foreach ($property['gallery'] as $image) {
                            echo '<img src="'.$image['file_url'].'">';
                        } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="description-content" role="tabpanel" aria-labelledby="description-tab">
                    <div class="p-3">
                        <h2 class="border-bottom pb-1">توضیحات تکمیلی این <?php echo $property['type_name']; ?></h2>
                        <p><?php echo $property['description']; ?></p>
                        <!--                        <code>--><?php //echo json_encode($property, 256 | 64) ?><!--</code>-->
                    </div>
                </div>
                <div class="tab-pane fade" id="panorama-content" role="tabpanel" aria-labelledby="panorama-tab">
                    <div class="p-3">

                    </div>
                </div>
                <div class="tab-pane fade" id="mapview-content" role="tabpanel" aria-labelledby="mapview-tab">
                    <div class="p-3">
                        <h2 class="border-bottom pb-1">موقعیت مکانی این <?php echo $property['type_name']; ?></h2>
                        <div style="height: 500px; width: 100%" data-zoom="<?php echo $property['zoom']; ?>" data-latitude="<?php echo $property['latitude']; ?>" data-longitude="<?php echo $property['longitude']; ?>" id="property-map" class="mapview"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="<?php assets('front/js/jquery-3.6.1.min.js'); ?>"></script>
<script src="<?php assets('front/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php assets('front/js/app.min.js'); ?>"></script>
<script src="<?php assets('front/js/fotorama.js'); ?>"></script>
<script src="<?php echo esc('http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js') ?>"></script>
<script>
    var map = null;
    var tabEl = document.querySelector('#mapview-tab')
    tabEl.addEventListener('shown.bs.tab', function (event) {
        let current_tab = event.target // newly activated tab
        console.log($(current_tab).data('bs-target'));
        // event.relatedTarget // previous active tab
        var map_element = $('#property-map');

        let mapOptions = {
            center: [map_element.data('latitude'), map_element.data('longitude')],
            zoom: map_element.data('zoom')
        }
        if (map != undefined || map != null) {
            map.remove();
        }
        map = new L.map('property-map', mapOptions);

        let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);

        let marker = new L.Marker([map_element.data('latitude'), map_element.data('longitude')])
            .bindPopup('<span style="font-family: \'IRANSans\'; text-align: right; line-height: 2; display: block; "> آدرس : <?php echo esc($property['address']); ?></span>').addTo(map);

    })

</script>
</body>
</html>