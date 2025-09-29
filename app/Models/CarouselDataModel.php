<?php

namespace App\Models;

use CodeIgniter\Model;

class CarouselDataModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'carousel_data';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['carousel_id', 'title', 'image_id', 'mobile_image_id', 'image_filepath', 'mobile_image_filepath', 'description', 'with_button', 'button_label', 'button_link', 'status', 'slide_order'];

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
        $builder = $db->table('carousel_data');

        $cols = ['id'];
        $builder->select(implode(",", $cols));
        $builder->where('carousel_id', $input['carousel_id']);
        $query = $builder->get();


        $count = $query->getNumRows();
        $data['recordsTotal'] = $count;

        $cols = [
            'image_filepath',
            'title',
            'description',
            'slide_order',
            'status',
            'id',
        ];

        $orderby = $cols[4] . " ASC";

        $builder->select(implode(",", $cols));
        $builder->where('carousel_id', $input['carousel_id']);

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
            $item['image'] = '<div class="text-center"><img src="'.base_url($result['image_filepath']).'" style="width: 100%;height: auto;"/></div>';

            $item['action'] = '<div class="text-center">';
            $item['action'] .= '<a style="padding: 2px 12px;font-size: 12px;" class="btn btn-primary" href="'. base_url("admin/carousel/edit_slide/" . $result['id']).'" title="Edit"><i class="fa fa-edit"></i> Edit</a> ';
            $item['action'] .= '<a style="padding: 2px 12px;font-size: 12px;" class="btn btn-danger" href="'. base_url("admin/carousel/delete_slide/" . $result['id']).'" title="Delete"><i class="fa fa-trash"></i> Delete</a>';
            $item['action'] .= '</div>';

            $data['data'][] = $item;
        }
        return $data;
    }
}