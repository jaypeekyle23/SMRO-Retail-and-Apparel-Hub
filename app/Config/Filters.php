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
            'isLoggedIn' => ['except' => [
                '/',
                'register',
                'login',
                'api/*'
            ]],

            'isGranted' => ['except' => [
                '/', 'register', 'login', 'logout', 'blocked', 'dashboard',
                'products', 'products/create', 'products/store', 'products/delete/*', 'products/edit/*', 'products/update/*',
                'inventory',
                'inventory/*',
                'pos',
                'pos/*',
                'menu-management',
                'menu-management/*',
                'users',
                'users/*',
                'api/*'
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