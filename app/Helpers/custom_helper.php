<?php
if ( ! function_exists('document_title')) {
    function document_title($title = '', $echo = true): ?string
    {
        $app            = config('App');
        $document_title = empty($title) ? $app->AppName : $title.' | '.$app->AppName;
        if ( ! $echo) {
            return $document_title;
        }
        echo $document_title;

        return null;
    }
}
if ( ! function_exists('assets')) {
    function assets($path = '', $echo = true): ?string
    {
        if (empty($path)) {
            return '';
        }
        if ( ! $echo) {
            return base_url('assets/'.$path);
        }
        echo base_url('assets/'.$path);

        return null;
    }
}
if ( ! function_exists('property_persian_status')) {
    function property_persian_status($status): array
    {
        switch ($status) {
            case 'pending' :
                $name  = 'در دست بررسی';
                $class = 'warning';
                break;
            case 'publish':
                $name  = 'منتشر شده';
                $class = 'primary';
                break;
            case 'sold':
                $name  = 'فروش رفته';
                $class = 'danger';
                break;
            default:
                $name  = 'نامشخص';
                $class = 'dark';
        }

        return ['class'=>$class, 'name'=> $name];
    }
}