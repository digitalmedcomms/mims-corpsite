<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['title', 'category_id', 'content', 'date', 'short_description', 'user_id', 'slug', 'featured_img_path', 'featured_img_id', 'status'];

    // Dates
    protected $useTimestamps = true;
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
    
    function getPosts($limit = 0){

        $db = \Config\Database::connect();
        $builder = $db->table('posts');

        $cols = [
            'posts.title',
            'posts.slug',
            'posts.date',
            'posts.featured_img_path',
            'posts.short_description',
            'posts.category_id',
            'post_categories.name as category_name',
            'post_categories.slug as category_slug',
            'posts.status',
            'posts.id',
        ];


        $builder->select(implode(",", $cols));
        $builder->join('post_categories', 'post_categories.id = posts.category_id', 'INNER');
        $builder->where('posts.status', 10);
        $builder->orderBy('posts.date', 'DESC');


        if($limit != 0){
            $builder->limit($limit);
        }

        $query = $builder->get();

        $articles = [];
        foreach($query->getResult('array') as $result){
            $result['date_formatted'] = date("M d, Y", strtotime($result['date']));
            $result['post_url'] = $result['category_slug'] . '/' . $result['slug'];

            $articles[date("Y", strtotime($result['date'])) ][] = $result; 
        }

        return $articles;
    }


    function getLatestPosts($limit = 0, $except_id = 0){

        $db = \Config\Database::connect();
        $builder = $db->table('posts');

        $cols = [
            'posts.title',
            'posts.slug',
            'posts.date',
            'posts.featured_img_path',
            'posts.short_description',
            'posts.category_id',
            'post_categories.name as category_name',
            'post_categories.slug as category_slug',
            'posts.status',
            'posts.id',
        ];


        $builder->select(implode(",", $cols));
        $builder->join('post_categories', 'post_categories.id = posts.category_id', 'INNER');
        $builder->where('posts.status', 10);
        $builder->orderBy('posts.date', 'DESC');

        if($except_id != 0){
            $builder->where('posts.id !=', $except_id);
        }

        if($limit != 0){
            $builder->limit($limit);
        }

        $query = $builder->get();

        $articles = [];
        foreach($query->getResult('array') as $result){
            $result['date_formatted'] = date("M d, Y", strtotime($result['date']));
            $result['post_url'] = $result['category_slug'] . '/' . $result['slug'];

            $articles[] = $result; 
        }

        return $articles;
    }

    function listing($input){
        $data = [];

        $db = \Config\Database::connect();
        $builder = $db->table('posts');

        $cols = ['id'];
        $builder->select(implode(",", $cols));
        $query = $builder->get();


        $count = $query->getNumRows();
        $data['recordsTotal'] = $count;

        $cols = [
            'posts.title',
            'posts.slug',
            'posts.date',
            'posts.category_id',
            'post_categories.name as category_name',
            'posts.status',
            'posts.id',
        ];

        $orderby = $cols[2] . " DESC";

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

        $builder->join('post_categories', 'post_categories.id = posts.category_id', 'INNER');
        $query = $builder->get();
        $count = $query->getNumRows();

        $data['recordsFiltered'] = $count;
        $data['data'] = array();

        foreach($query->getResult('array') as $result){
            $item = $result;
            $item['status'] = '<div class="text-center">'.getStatusBadge($result['status']).'</div>';

            $item['date'] = date("M d, Y", strtotime($item['date']));
            $item['action'] = '<div class="text-center">';
            $item['action'] .= '<a style="padding: 2px 12px;font-size: 12px;" class="btn btn-primary" href="'. base_url("admin/news-updates/posts/edit/" . $result['id']).'" title="Edit"><i class="fa fa-edit"></i> Edit</a>';
            $item['action'] .= '</div>';

            $data['data'][] = $item;
        }
        return $data;
    }
}