<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyGalleryModel;
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
        $property         = $this->model->getProperty($id);
        $data['property'] = $property;
        $types            = model(PropertyTypeModel::class)->select('id,name')->findAll();
        foreach ($types as $type) {
            $data['types'][$type['id']] = $type['name'];
        }
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
//            $gallery_items = json_decode($this->request->getVar('gallery_images'), true);

            $data_insert = [
                'name'        => $this->request->getVar('name'),
                'type_id'     => $this->request->getVar('type_id') ?? 1,
                'description' => $this->request->getVar('description'),
                'address'     => $this->request->getVar('address'),
                'latitude'    => $this->request->getVar('latitude') ?? 0,
                'longitude'   => $this->request->getVar('longitude') ?? 0,
                'zoom'        => $this->request->getVar('zoom') ?? 14,
                'status'      => $this->request->getVar('status') ?? 'pending',
                'price'       => $this->request->getVar('price') ?? 0,
                'final_price' => $this->request->getVar('final_price') ?? $this->request->getVar('price') ?? 0,
            ];
            $this->model->insert($data_insert);
            $id            = $this->model->getInsertID();
//            $this->saveGalleryItems($id,$gallery_items);
            Services::session()->setTempdata('success', 'property inserted');

            return redirect()->to(route_to('admin-property-show', $id));
        } catch (\ReflectionException $e) {
            $message = $e->getMessage();
            Services::session()->setTempdata('error', $message);

            return redirect()->to(route_to('admin-property-create'));
        }

    }

    /**
     * @param $id
     * @param  array  $gallery_items
     *
     * @return bool|int
     * @throws \ReflectionException
     */
    public function saveGalleryItems($id, array $gallery_items)
    {
        $gallery_model = model(PropertyGalleryModel::class);
        $gallery_data  = [];
        foreach ($gallery_items as $gallery_item) {
            $gallery_item['property_id'] = $id;
            $gallery_data[]              = $gallery_item;
        }

        return $gallery_model->insertBatch($gallery_data);

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
                'zoom'        => $this->request->getVar('zoom') ?? $property['zoom'],
                'status'      => $this->request->getVar('status') ?? $property['status'],
                'price'       => $this->request->getVar('price') ?? $property['price'],
                'final_price' => $this->request->getVar('final_price') ?? $property['final_price'],
            ];

            $update_result = $this->model->update($id, $data_update);

            if ($file = $this->request->getFile('file')) {
                if ($file->isValid() && ! $file->hasMoved()) {
                    // Get file name and extension
                    $name = $file->getName();
                    $ext  = $file->getClientExtension();

                    // Get random file name
                    $newName = $file->getRandomName();

                    // Store file in public/uploads/ folder
                    $file->move(FCPATH.'/uploads/galleries', $newName);
//                    $file->move('uploads', $newName);

                    // Response
                    $data['success'] = true;
                    $data['data'] = [
                        'property_id'=>$this->request->getVar('property_id'),
                        'file_path'=>FCPATH.'/uploads/galleries/'.$newName,
                        'file_url'=>site_url('uploads/galleries/'.$newName),
                    ];
                    $model = model(PropertyGalleryModel::class);
                    $gallery_insert = $model->insert($data['data']);
//                    $data['message'] = 'Uploaded Successfully!';
//                } else {
                    // Response
//                    $data['success'] = false;
//                    $data['error'] = 'file is not valid or not moved';
//                    $data['message'] = 'File not uploaded.';
                }
            }

            log_message(3, $update_result);

//            Services::session()->setTempdata('success', 'property updated');


            return $this->response->setJSON(['success'=>true,'message'=>'property updated']);

//            return redirect()->to(route_to('admin-property-show', $id));
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

    public function getPropertyGalleryItems($id)
    {
//        echo 'test '.$id;die();

        $model = model(PropertyGalleryModel::class);
        $items = $model->select()->where('property_id',$id)->findAll();
        foreach ($items as $k => $item) {
            $items[$k]['name'] = basename($item['file_path']);
            $items[$k]['size'] = filesize($item['file_path']);
            unset($items[$k]['updated_at'],$items[$k]['created_at']);
        }
        return $this->response->setJSON($items);
    }
}
