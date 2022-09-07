<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'properties';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'type_id', 'description', 'address', 'latitude', 'longitude', 'status', 'price', 'final_price'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [

    ];
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


    /**
     * @param $id
     *
     * @return array|object|null
     */
    public function getProperty($id = null)
    {
        $this->builder()->select(['properties.*', 'property_types.name AS type_name'])
             ->join('property_types', 'properties.type_id = property_types.id')
             ->where('properties.id', $id);
        $query = $this->builder->get();

        $row            = $query->getRowArray();
        $gallery        = model(PropertyGalleryModel::class);
        $meta           = model(PropertyMetaModel::class);
        $row['gallery'] = $gallery->getPropertyGallery($id);
        $row['meta']    = $meta->getPropertyMeta($id, 1);

        return $row;
    }

    /**
     * @param  int  $offset
     * @param  int  $limit
     *
     * @return array
     */
    public function getProperties(int $offset = 0, int $limit = 12): array
    {
        $query   = $this->builder()->select(['properties.*', 'property_types.name AS type_name', 'rs_property_galleries.file_url AS thumbnail'])
                        ->join('property_types', 'properties.type_id = property_types.id')
                        ->join('property_galleries', 'properties.id = property_galleries.property_id', 'left')
                        ->offset($offset)
                        ->limit($limit)
                        ->orderBy('id', 'desc')->groupBy('properties.id');
        $results = $query->get()->getResultArray();

//        $results = $this->builder()->select()->get()->getResultArray();

        $meta = model(PropertyMetaModel::class);
//        $metadata = $meta->getPropertyMeta(10, 1);
        foreach ($results as $key => $result) {
            $results[$key]['meta'] = $meta->getPropertyMeta($result['id'], 1);
        }

        return $results;
    }


}
