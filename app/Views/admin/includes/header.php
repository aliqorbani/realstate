<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - <?php /** @var string $page_title */
        document_title($page_title) ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo assets('admin/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?php echo assets('admin/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets('admin/css/customized.css'); ?>" rel="stylesheet">
    <?php if(isset($custom_styles)){
        echo $custom_styles;
    } ?>

</head>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
