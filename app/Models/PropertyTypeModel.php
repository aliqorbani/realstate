<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyTypeModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'property_types';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
//    protected $protectFields = true;
    protected $allowedFields = ['name', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
//    protected $validationRules = [
//        'name' => 'required',
//
//    ];
//    protected $validationMessages = [
//        'name' => [
//            'required' => 'نام اجباری است'
//        ]
//    ];
//    protected $skipValidation = true;
//    protected $cleanValidationRules = true;

    // Callbacks
//    protected $allowCallbacks = true;
//    protected $beforeInsert = [];
//    protected $afterInsert = [];
//    protected $beforeUpdate = [];
//    protected $afterUpdate = [];
//    protected $beforeFind = [];
//    protected $afterFind = [];
//    protected $beforeDelete = [];
//    protected $afterDelete = [];


}
