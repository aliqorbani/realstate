<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['property']   = model(PropertyModel::class)->getProperties();
        $data['page_title'] = 'داشبورد';
        view('admin/dashboard', $data);
    }
}
