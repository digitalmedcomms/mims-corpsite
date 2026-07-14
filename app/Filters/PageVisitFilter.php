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
            
            // Exclude admin pages
            $uriPath = ltrim($request->getUri()->getPath(), '/');
            if (str_starts_with($uriPath, 'index.php/')) {
                $uriPath = substr($uriPath, 10);
            } elseif ($uriPath === 'index.php') {
                $uriPath = '';
            }
            $uriLower = strtolower($uriPath);
            if (str_starts_with($uriLower, 'admin/') || $uriLower === 'admin') {
                return;
            }

            $url = current_url();
            $url = str_replace('/index.php/', '/', $url);
            if (str_ends_with($url, '/index.php')) {
                $url = substr($url, 0, -10);
            }
                
            $mainPagesMap = [
                ""                                            => "Home",
                "about-us"                                    => "About Us",
                "our-solutions"                               => "Our Solutions",
                "our-solutions/for-hcp"                       => "Solutions for HCP",
                "our-solutions/for-pharmaceutical-companies"  => "Solutions for Pharma",
                "our-solutions/for-healthcare-institutions"   => "Solutions for Healthcare Institutions",
                "our-leaders"                                 => "Our Leaders",
                "contact-us"                                  => "Contact Us",
                "join-us"                                     => "Join Us",
                "news-updates"                                => "News & Updates",
                "mims-privacy-policy"                         => "Privacy Policy"
            ];

            // do not track visits from crawlers
            if ($request->getUserAgent()->isRobot()) {
                return;
            }

            // track main page only. 
            // for article pages (under News controller and article method), track it from the controller
            if (!array_key_exists($uriLower, $mainPagesMap)) {
                return;
            }

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
