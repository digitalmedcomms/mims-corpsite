<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'isLoggedIn'     => \App\Filters\Authentication::class,
        'isGranted'     => \App\Filters\Authorization::class,
        'check-admin' => \App\Filters\CheckAdmin::class,
        'isMaintenance' => \App\Filters\Maintenance::class,
        'secure-api'     => \App\Filters\SecureAPI::class,
        'pageVisit'      => \App\Filters\PageVisitFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public array $globals = [
        'before' => [
            'pageVisit' => ['except' => ['assets/*', 'uploads/*', 'admin/*', 'api/*', 'Auth/*']],
            // 'honeypot',
            'csrf' => ['except' => ['vr-run-internal-cron', 'api/*', 'admin/*']],
            // 'invalidchars',
            'isLoggedIn'    => ['except' => ['/', 'Auth/*', 'api/*', 'blocked', 'maintenance', 'about-us', 'our-solutions', 'our-solutions/*', 'our-leaders', 'contact-us', 'contact-us/*', 'join-us','join-us/*', 'news-updates']],
            'isGranted'     => ['except' => ['/', 'Auth/*', 'api/*', 'blocked', 'maintenance', 'about-us', 'our-solutions', 'our-solutions/*', 'our-leaders', 'contact-us', 'contact-us/*','join-us','join-us/*', 'news-updates']],
            'isMaintenance' => ['except' => ['Auth/*', 'api/*', 'blocked', 'admin/*', 'maintenance']],
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public array $filters = [];
}
