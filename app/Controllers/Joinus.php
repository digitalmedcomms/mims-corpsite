<?php

namespace App\Controllers;

use App\Models\CareersModel;
use App\Models\OfficesModel;

class Joinus extends BaseController
{

    public function __construct()
    {
    }


    public function index()
    {
        $careersModel = new CareersModel();
        
        $data = [
            'careers' => [],
            'job_types' => $careersModel->job_types,
            'job_locations' => $careersModel->job_locations
        ];
        
        // PAGE HEAD PROCESSING
        return view('components/header', array(
            'title' => 'MIMS Singapore (Headquarters) | Asia Pacific leading multichannel provider of medical information',
            'description' => 'MIMS is headquartered in Singapore. We have a strong presence in Asia Pacific supported by over 1,000 employees across 36 local offices.',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'MIMS Singapore (Headquarters) | Asia Pacific leading multichannel provider of medical information',
                'description' => 'MIMS is headquartered in Singapore. We have a strong presence in Asia Pacific supported by over 1,000 employees across 36 local offices.',
                'image' => IMG_URL . ''
            ),
            'nav' => 'joinus',
            'styles' => array(
                'plugins/font_awesome',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap',
                COMPILED_ASSETS_PATH . 'css/components/fontawesome',
                COMPILED_ASSETS_PATH . 'css/components/owl',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-main',
                COMPILED_ASSETS_PATH . 'css/components/bootstrap-select',
                COMPILED_ASSETS_PATH . 'css/components/buttons',
                COMPILED_ASSETS_PATH . 'css/components/global',
                COMPILED_ASSETS_PATH . 'css/components/animations',
                COMPILED_ASSETS_PATH . 'css/components/timeline',
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/joinus'
            )
        ))
        .view('Pages/join-us', $data)
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/wow.min.js',
                ASSETS_URL . 'js/plugins/timeline.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/joinus.min.js?123',
            )
        ))
        .view('components/footer');
    }

    public function careers(){
        $data = [
            'message' => 'Invalid request.',
            'success' => 0,
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash()
        ];

        if($this->request->isAJAX() && $this->request->getMethod() === 'post'){
            $search = $this->request->getPost('search');
            $location = $this->request->getPost('location');
            $job_type = $this->request->getPost('job_type');
            $job_location = $this->request->getPost('job_location');
            $page = $this->request->getPost('page') ?: 1;
            $per_page = 9;
            $offset = ($page - 1) * $per_page;

            $careersModel = new CareersModel();
            
            $applyFilters = function($m) use ($search, $location, $job_type, $job_location) {
                $m->join('offices', 'offices.id = careers.office_id', 'INNER');
                $m->where('careers.status', 1);

                if (!empty($search)) {
                    $m->groupStart()
                        ->like('careers.job_title', $search)
                        ->orLike('careers.job_description', $search)
                        ->groupEnd();
                }

                if (!empty($location)) {
                    $m->groupStart()
                        ->like('offices.name', $location)
                        ->orLike('offices.address', $location)
                        ->groupEnd();
                }

                if (!empty($job_type)) {
                    $m->where('careers.job_type', $job_type);
                }

                if (!empty($job_location)) {
                    $m->where('careers.job_location', $job_location);
                }
            };

            // Count query
            $applyFilters($careersModel);
            $total_records = $careersModel->countAllResults();
            $total_pages = ceil($total_records / $per_page);

            // Fetch query
            $applyFilters($careersModel);
            $careersModel->select('careers.*, offices.name as office_name, offices.address as office_address');
            $careersModel->orderBy('careers.id', 'DESC');
            $careers = $careersModel->findAll($per_page, $offset);

            $viewData = [
                'careers' => $careers,
                'job_types' => $careersModel->job_types,
                'job_locations' => $careersModel->job_locations
            ];

            $html = '';
            if (!empty($careers)) {
                foreach ($careers as $career) {
                    $job_type_label = strtoupper($viewData['job_types'][$career['job_type']] ?? '');
                    $job_location_label = strtoupper($viewData['job_locations'][$career['job_location']] ?? '');
                    
                    $html .= '<div class="job-item">
                        <div class="tags">
                            <div class="tag-item green">' . $job_type_label . '</div>
                            <div class="tag-item blue">' . $job_location_label . '</div>
                        </div>
                        <div class="title">
                            <h3>' . $career['job_title'] . '</h3>
                        </div>
                        <div class="company-info">
                            <div class="logo"></div>
                            <div class="details">
                                <div class="logo-name">' . $career['office_name'] . '</div>
                                <div class="company-address"><i class="fa fa-map-pin"></i> ' . $career['office_address'] . '</div>
                            </div>
                        </div>
                        <div class="job-detail">
                            ' . $career['job_description'] . '
                        </div>
                        <div class="buttons">
                            <a href="' . $career['link'] . '" target="_blank" class="btn btn-red">Read more <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>';
                }
            } else {
                $html = '<div class="text-center" style="padding: 100px 0;width:100%;">
                    <h3 class="text-blue">No career opportunities found.</h3>
                    <p class="text-grayish-blue">Try adjusting your search filters.</p>
                </div>';
            }

            $data['success'] = 1;
            $data['html'] = $html;
            $data['total_pages'] = $total_pages;
            $data['current_page'] = (int)$page;
            $data['total_records'] = $total_records;
            $data['message'] = 'Success';
        }
        
        return $this->response->setJSON($data);
    }

    //maintenance mode
    public function maintenance()
    {
        return view('maintenance');
    }
}
