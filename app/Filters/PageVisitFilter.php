<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PageVisitModel;

class PageVisitFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during normal execution.
     * However, when an abnormal state is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script execution will end and that
     * Response will be sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Only track GET requests and not CLI/AJAX
        if ($request->getMethod() === 'get' && !is_cli() && !$request->isAJAX()) {
            
            $url = current_url();
            
            // Exclude assets by extension
            $extension = pathinfo($url, PATHINFO_EXTENSION);
            if (!empty($extension)) {
                $excluded_extensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'otf', 'map', 'json', 'pdf'];
                if (in_array(strtolower($extension), $excluded_extensions)) {
                    return;
                }
            }

            $pageVisitModel = new PageVisitModel();
            
            $ipAddress = $request->getIPAddress();
            $userAgent = $request->getUserAgent()->getAgentString();
            $referrer = $request->getUserAgent()->getReferrer();

            $pageVisitModel->insert([
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'url'        => $url,
                'referrer'   => $referrer,
            ]);
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
