<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyGalleryModel;
use Config\Services;

class UploadController extends BaseController
{
    public function index()
    {
        //
    }

    public function uploadGalleryItems()
    {
        $data          = [];
//        $data['token'] = csrf_token();

        $validation = Services::validation();

        $validation->setRules([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,jpeg,jpg,png]',
        ]);

        if ($validation->withRequest($this->request)->run() == false) {
            $data['success'] = false;
            $data['error']   = $validation->getError('file');
        } else {
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
                    $id = $model->insert($data['data']);
                    $data['message'] = 'Uploaded Successfully!';

                } else {
                    // Response
                    $data['success'] = false;
                    $data['error'] = 'file is not valid or not moved';
                    $data['message'] = 'File not uploaded.';
                }
            } else {
                $data['success'] = false;
                $data['error'] = 'file not found';
                $data['message'] = 'File not uploaded.';
            }
        }
        return $this->response->setJSON($data);
    }
}
