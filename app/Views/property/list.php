<?php
/** @var array $properties */
?><!doctype html>
<html lang="en">
<head>
    <title><?php document_title('صفحه اصلی'); ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php assets('front/css/style.css'); ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h1 class="font-weight-bold border-bottom border-bottom-dark mb-3">لیست آخرین فایلها فروش</h1>
    <div class="row">
        <?php
        foreach ($properties as $property) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card bg-white card-has-ribbon">
                    <div class="ribbon ribbon-<?php echo $property['status']; ?>"><span><?php echo $property['status']; ?></span></div>
                    <a href="<?php echo route_to('single-property', $property['id']); ?>">
                        <img class="card-img-top" src="<?php echo esc($property['thumbnail'], 'attr'); ?>" alt="<?php echo esc($property['name']); ?>">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a class="property-title-link" href="<?php echo route_to('single-property', $property['id']); ?>">
                                <?php echo esc($property['type_name'].' '.$property['name']); ?>
                            </a>
                        </h4>
                        <div class="card-text" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="<?php echo esc($property['description'], 'attr'); ?>" title="توضیحات">
                            <?php echo excerpt($property['description'], null, 50) ?>
                        </div>
                    </div>
                    <ul class="list-unstyled list-group list-group-flush">
                        <li class="list-group-item small d-flex justify-content-between price"><span class="meta-title">قیمت</span><span class="badge small bg-black">
                                <?php echo sprintf('<span class="font-monospace amount">%1$s</span> %2$s', format_number($property['price']), 'تومان'); ?>
                            </span></li>
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
        <?php } ?>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php assets('front/js/jquery-3.6.1.min.js'); ?>"></script>
<script src="<?php assets('front/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php assets('front/js/app.min.js'); ?>"></script>
</body>
</html>