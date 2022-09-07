<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyTypeModel;
use Config\Services;

class PropertyTypeController extends BaseController
{
    /**
     * @var PropertyTypeModel|mixed
     */
    private $model;

    public function __construct()
    {
        $this->model = model(PropertyTypeModel::class);
    }

    public function index()
    {
        $data['types']      = $this->model->orderBy('id', 'desc')->findAll();
        $data['page_title'] = 'انواع مستقلات';
        view('admin/type/index', $data);
    }

    public function show($id)
    {
        $type               = $this->model->find($id);
        $data['page_title'] = $type['name'];
        $data['type']       = $type;

        return view('admin/type/edit', $data);
    }

    public function create()
    {
        $data['page_title'] = 'ساخت نوع جدید';

        return view('admin/type/create', $data);
    }

    public function store()
    {
        $data_insert = [
            'name'        => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
        ];
        $this->model->insert($data_insert);
        $id = $this->model->getInsertID();
        Services::session()->setTempdata('inserted', true);

        return redirect()->to(route_to('admin-property-types-show', $id))->withHeaders();
    }

    public function update($id)
    {
        $data_update = [
            'name'        => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
        ];
        $this->model->update($id, $data_update);
        Services::session()->setTempdata('updated', true);

        return redirect()->to(route_to('admin-property-types-show', $id));
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete($id);
        Services::session()->setTempdata('removed', true);

        return redirect()->to(route_to('admin-property-types-index'));

    }


}
