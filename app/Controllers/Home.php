<?php

namespace App\Controllers;

use App\Models\PropertyModel;
use App\Models\PropertyGalleryModel;
use App\Models\PropertyMetaModel;

class Home extends BaseController
{
    public function index(): string
    {
        $property           = model(PropertyModel::class);
        $properties         = $property->getProperties();
        $data['properties'] = $properties;
        $data['sidebar']    = '';

        return view('property/list', $data);
    }
//    public function feed(): string
//    {
//        $rss = new RSSFeeder();
//        $property           = model(PropertyModel::class);
//        $properties         = $property->getProperties();
//
//    }

    public function show($id): string
    {
        $property                    = model(PropertyModel::class);
        $data['property']            = $property->getProperty($id);
        return view('property/single', $data);

    }
}
