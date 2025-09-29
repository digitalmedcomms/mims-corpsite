<?php

namespace App\Models;

use CodeIgniter\Model;

class CarouselModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'carousels';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['name', 'description', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function listing($input){
        $data = [];

        $db = \Config\Database::connect();
        $builder = $db->table('carousels');

        $cols = ['id'];
        $builder->select(implode(",", $cols));
        $query = $builder->get();


        $count = $query->getNumRows();
        $data['recordsTotal'] = $count;

        $cols = [
            'carousels.name',
            'carousels.description',
            'carousels.status',
            'carousels.id',
        ];

        $orderby = $cols[1] . " DESC";

        $builder->select(implode(",", $cols));

        if(isset($input['limit']) ){
            $builder->limit($input['limit']);
        }

        if(isset($input['start']) && !empty($input['start']) ){
            $builder->limit($input['limit'], $input['start']);
        }

        if(isset($input['order']) && !empty($input['order']) ){
            $orderby = $cols[$input['order'][0]['column']] . " " . $input['order'][0]['dir'];
        }

        $builder->orderBy($orderby);

        $query = $builder->get();
        $count = $query->getNumRows();

        $data['recordsFiltered'] = $count;
        $data['data'] = array();

        foreach($query->getResult('array') as $result){
            $item = $result;
            $item['status'] = '<div class="text-center">'.getStatusBadge($result['status']).'</div>';

            $item['action'] = '<div class="text-center">';
            $item['action'] .= '<a style="padding: 2px 12px;font-size: 12px;" class="btn btn-primary" href="'. base_url("admin/carousel/view/" . $result['id']).'" title="View"><i class="fa fa-search"></i> View</a>';
            $item['action'] .= '</div>';

            $data['data'][] = $item;
        }
        return $data;
    }
}