<?php
namespace App\Controllers;

class ErrorController extends BaseController{

    public function show404()
    {
        $this->response->setStatusCode(404);
        echo view('components/header', array(
            'title' => 'MIMS | Asia Pacific leading multichannel provider of medical information',
            'description' => 'MIMS host a wealth of healthcare services to healthcare professionals, pharmaceutical companies and healthcare institutions.',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'MIMS | Asia Pacific leading multichannel provider of medical information',
                'description' => 'MIMS host a wealth of healthcare services to healthcare professionals, pharmaceutical companies and healthcare institutions.',
                'image' => IMG_URL . ''
            ),
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
                COMPILED_ASSETS_PATH . 'css/components/navigation_bar',
                COMPILED_ASSETS_PATH . 'css/components/footer',
                COMPILED_ASSETS_PATH . 'css/pages/home'
            )
        ))
        .view('errors/html/production')
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/components/wow.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/home.min.js',
            )
        ))
        .view('components/footer');
    }

    
}