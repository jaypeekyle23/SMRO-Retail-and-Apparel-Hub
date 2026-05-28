<?php

namespace Config;

use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use App\Filters\Authorization;
use App\Filters\Authentication;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Config\Filters as BaseFilters;

class Filters extends BaseFilters
{
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
        'isLoggedIn'    => Authentication::class,
        'isGranted'     => Authorization::class,
        'bearerToken'   => \App\Filters\BearerToken::class,
    ];

    public array $required = [
        'before' => [
            'forcehttps',
            'pagecache',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    public array $globals = [
        'before' => [
            'csrf' => ['except' => ['api/*']],
            // Not logged in? Redirect to login — except for public routes and API
            'isLoggedIn' => ['except' => [
                '/',
                'register',
                'login',
                'api/*',
            ]],

            // Logged in but not authorized? Redirect to blocked page
            // Only except: public routes, dashboard (all roles), profile (all roles), and API
            'isGranted' => ['except' => [
                '/',
                'register',
                'login',
                'logout',
                'blocked',
                'dashboard',
                'dashboard/*',
                'profile',
                'profile/*',
                'api/*',
                'checkout',
                'checkout/*',
                'cart',
                'cart/*',
                'order-confirmed',
                'order-confirmed/*',
                'my-orders/return',
            ]],
        ],
        'after' => [
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}