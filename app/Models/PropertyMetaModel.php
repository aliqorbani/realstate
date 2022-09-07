<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyMetaModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'property_metas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['property_id', 'group_id', 'meta_key', 'meta_title', 'meta_value'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getPropertyMeta($id, $group_id = null, $in_ex = true)
    {
        $result = $this->builder()->select()->where('property_id', $id);
        if ($group_id) {
            if ($in_ex) {
                $result = $result->where('group_id', $group_id);
            } else {
                $result = $result->where('group_id !=', $group_id);
            }
        }

        return $result->get()->getResultArray();
    }
}
