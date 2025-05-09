<?php

namespace App\Controllers;

class Solutions extends BaseController
{

    public function index()
    {
      
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
                COMPILED_ASSETS_PATH . 'css/pages/solutions'
            )
        ))
        .view('Pages/our-solutions/index')
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/home.min.js',
            )
        ))
        .view('components/footer');
    }



    public function for_hcp()
    {
      
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
                COMPILED_ASSETS_PATH . 'css/pages/solutions-hcp'
            )
        ))
        .view('Pages/our-solutions/hcp')
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/home.min.js',
            )
        ))
        .view('components/footer');
    }


    public function for_companies()
    {
      
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
                COMPILED_ASSETS_PATH . 'css/pages/solutions-companies'
            )
        ))
        .view('Pages/our-solutions/companies')
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/home.min.js',
            )
        ))
        .view('components/footer');
    }


    public function for_institution()
    {
      
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
                COMPILED_ASSETS_PATH . 'css/pages/solutions-institution'
            )
        ))
        .view('Pages/our-solutions/institution')
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/home.min.js',
            )
        ))
        .view('components/footer');
    }

}
