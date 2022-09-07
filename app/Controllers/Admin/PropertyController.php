<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyModel;
use App\Models\PropertyTypeModel;
use Config\Services;

class PropertyController extends BaseController
{
    /**
     * @var PropertyModel|mixed
     */
    private $model;

    public function __construct()
    {
        $this->model = model(PropertyModel::class);
    }

    public function index()
    {
        $data['properties'] = $this->model->getProperties();
        $data['page_title'] = 'مستقلات';
        view('admin/property/index', $data);
    }

    public function show($id)
    {
        $property           = $this->model->getProperty($id);
        $data['property']   = $property;
        $data['types']      = model(PropertyTypeModel::class)->findAll();
        $data['page_title'] = 'ویرایش '.$property['type_name'].' '.$property['name'];

        return view('admin/property/edit', $data);
    }

    public function create()
    {
        $data['page_title'] = 'افزودن';

        return view('admin/property/create', $data);
    }

    public function store()
    {
        try {
            $data_insert = [
                'name'        => $this->request->getVar('name'),
                'type_id'     => $this->request->getVar('type_id') ?? 1,
                'description' => $this->request->getVar('description'),
                'address'     => $this->request->getVar('address'),
                'latitude'    => $this->request->getVar('latitude') ?? 0,
                'longitude'   => $this->request->getVar('longitude') ?? 0,
                'status'      => $this->request->getVar('status') ?? 'pending',
                'price'       => $this->request->getVar('price') ?? 0,
                'final_price' => $this->request->getVar('final_price') ?? $this->request->getVar('price') ?? 0,
            ];
            $this->model->insert($data_insert);
            $id = $this->model->getInsertID();
            Services::session()->setTempdata('success', 'property inserted');

            return redirect()->to(route_to('admin-property-show', $id));
        } catch (\ReflectionException $e) {
            $message = $e->getMessage();
            Services::session()->setTempdata('error', $message);

            return redirect()->to(route_to('admin-property-create'));
        }

    }

    public function update($id)
    {
        try {
            $property    = $this->model->getProperty($id);
            $data_update = [
                'name'        => $this->request->getVar('name') ?? $property['name'],
                'type_id'     => $this->request->getVar('type_id') ?? $property['type_id'],
                'description' => $this->request->getVar('description') ?? $property['description'],
                'address'     => $this->request->getVar('address') ?? $property['address'],
                'latitude'    => $this->request->getVar('latitude') ?? $property['latitude'],
                'longitude'   => $this->request->getVar('longitude') ?? $property['longitude'],
                'status'      => $this->request->getVar('status') ?? $property['status'],
                'price'       => $this->request->getVar('price') ?? $property['price'],
                'final_price' => $this->request->getVar('final_price') ?? $property['final_price'],
            ];

            $this->model->update($id, $data_update);
            Services::session()->setTempdata('success', 'property updated');

            return redirect()->to(route_to('admin-property-show', $id));
        } catch (\ReflectionException $e) {
            $message = $e->getMessage();
            Services::session()->setTempdata('error', $message);

            return redirect()->to(route_to('admin-property-show', $id));
        }

    }

    public function delete($id)
    {
        try {
            $this->model->where('id', $id)->delete($id);
            Services::session()->setTempdata('success', 'removed successfully');

            return redirect()->to(route_to('admin-property-index'));
        } catch (\ReflectionException $e) {
            $message = $e->getMessage();
            Services::session()->setTempdata('error', $message);

            return redirect()->to(route_to('admin-property-index'));
        }

    }


}
