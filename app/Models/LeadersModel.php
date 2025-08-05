<?php

namespace App\Models;

use CodeIgniter\Model;

class LeadersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'leaders';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['name','leader_type_id','image_id','image_path','designation','biography','status','order','countries','practice'];

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
        $builder = $db->table('leaders');

        $cols = ['id'];
        $builder->select(implode(",", $cols));
        $query = $builder->get();


        $count = $query->getNumRows();
        $data['recordsTotal'] = $count;

        $cols = [
            'leaders.name',
            'leaders.leader_type_id',
            'leaders.image_path',
            'leaders.designation',
            'leaders.biography',
            'leaders.status',
            'leaders.order',
            'leader_types.name as leader_type_name',
            'leaders.id',
        ];

        $orderby = $cols[1] . " ASC," . $cols[6] . " ASC";

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
        $builder->join('leader_types', 'leader_types.id = leaders.leader_type_id', 'inner');

        $query = $builder->get();
        $count = $query->getNumRows();

        $data['recordsFiltered'] = $count;
        $data['data'] = array();

        foreach($query->getResult('array') as $result){
            $item = $result;
            $item['status'] = '<div class="text-center">'.getStatusBadge($result['status']).'</div>';

            $item['image'] = !empty($result['image_path']) ? '<div class="text-center"><img src="' . base_url($result['image_path']) . '" style="width: 100px;"></div>' : '';
            $item['name'] = '<div><strong>'.$result['name'].'</strong></div><div>'.$result['designation'].'</div>';

            $item['action'] = '<div class="text-center">';
            $item['action'] .= '<a style="padding: 2px 12px;font-size: 12px;" class="btn btn-primary" href="'. base_url("admin/leaders/edit/" . $result['id']).'" title="Edit"><i class="fa fa-edit"></i> Edit</a> ';
            $item['action'] .= '<a style="padding: 2px 12px;font-size: 12px;" class="btn btn-danger" href="'. base_url("admin/leaders/delete/" . $result['id']).'" title="Remove"><i class="fa fa-trash"></i> Remove</a>';
            $item['action'] .= '</div>';

            $data['data'][] = $item; 
        }
        return $data;
    }
}