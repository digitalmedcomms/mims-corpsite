<?php

namespace App\Controllers;

use App\Models\PostsModel;
use App\Models\PostCategoriesModel;
use App\Models\FormsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function index()
    {
        $data = [];
        $objPost = new PostsModel;
        $data['articles'] = $objPost->getPosts();

        // PAGE HEAD PROCESSING
        return view('components/header', array(
            'title' => 'News & Updates',
            'description' => 'MIMS is headquartered in Singapore. We have a strong presence in Asia Pacific supported by over 1,000 employees across 36 local offices.',
            'url' => BASE_URL,
            'keywords' => '',
            'meta' => array(
                'title' => 'News & Updates',
                'description' => 'MIMS is headquartered in Singapore. We have a strong presence in Asia Pacific supported by over 1,000 employees across 36 local offices.',
                'image' => IMG_URL . ''
            ),
            'nav' => 'news-updates',
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
                COMPILED_ASSETS_PATH . 'css/pages/blog-landing'
            )
        ))
        .view('Pages/news-updates', $data)
        .view('components/scripts_render', array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                ASSETS_URL . 'js/plugins/jquery.dotdotdot.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/wow.min.js',
                ASSETS_URL . 'js/plugins/timeline.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                ASSETS_URL . 'js/pages/blog_landing.min.js?12',
            )
        ))
        .view('components/footer');
    }

    public function article($category_slug, $article_slug){
        $data = [];

        $objPost = new PostsModel;
        $objPostCategories = new PostCategoriesModel;

        $category = $objPostCategories->where('slug', $category_slug)->first();
        if(empty($category)){
            throw new PageNotFoundException('The requested item was not found.');
        }
        $post = $objPost->where('slug', $article_slug)->where('status', 10)->first();
        if(empty($post)){
            throw new PageNotFoundException('The requested item was not found.');
        }

        $data['post'] = $post;
        $data['category'] = $category;

        $objForms = new FormsModel();
        $data['form'] = null;
        $js_scripts = array(
            'scripts' => array(
                'https://code.jquery.com/jquery-3.5.1.min.js' => array(
                    'integrity' => 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=',
                    'crossorigin' => 'anonymous'
                ),
                ASSETS_URL . 'js/plugins/popper.min.js',
                ASSETS_URL . 'js/plugins/bootstrap/bootstrap.min.js',
                ASSETS_URL . 'js/plugins/bootstrap-select.min.js',
                ASSETS_URL . 'js/plugins/jquery.dotdotdot.min.js',
                ASSETS_URL . 'js/components/global.min.js',
                ASSETS_URL . 'js/plugins/owl.carousel.min.js',
                ASSETS_URL . 'js/components/wow.min.js',
                ASSETS_URL . 'js/plugins/timeline.min.js',
                ASSETS_URL . 'js/components/navigation_bar.min.js',
                
            )
        );

        if (!empty($post['form_id'])) {
            $js_scripts['scripts'][] = 'https://formbuilder.online/assets/js/form-render.min.js';
            $data['form'] = $objForms->where('id', $post['form_id'])->where('status', 1)->first();
        }
        $js_scripts['scripts'][] = ASSETS_URL . 'js/pages/blog.min.js?1';

        $data['latest_posts'] = $objPost->getLatestPosts(4, $post['id']);

        // PAGE HEAD PROCESSING
        return view('components/header', array(
            'title' => $post['title'],
            'description' => $post['short_description'],
            'url' => base_url($category_slug . '/' . $article_slug),
            'keywords' => '',
            'meta' => array(
                'title' => $post['title'],
                'description' => $post['short_description'],
                'image' => base_url($post['featured_img_path'])
            ),
            'nav' => 'news-updates',
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
                COMPILED_ASSETS_PATH . 'css/pages/blog'
            )
        ))
        .view('Pages/article', $data)
        .view('components/scripts_render', $js_scripts)
        .view('components/footer');
    }

}
