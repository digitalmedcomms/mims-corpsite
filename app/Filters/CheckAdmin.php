<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CheckAdmin implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        helper('Custom');
        if (!is_admin()) {
            return redirect()->to(admin_url());
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
