<?php
// Load custom config
if (file_exists($this->DocPath() . 'config_' . $this->Environment() . '.php')) {
    $customConfig = $this->loadConfig($this->DocPath() . 'config_' . $this->Environment() . '.php');
} elseif (file_exists($this->DocPath() . 'config.php')) {
    $customConfig = $this->loadConfig($this->DocPath() . 'config.php');
} else {
    $customConfig = [];
}

if (!is_array($customConfig)) {
    throw new Enlight_Exception('The custom configuration file must return an array.');
}

return array_replace_recursive([
    'custom' => [],
    'trustedproxies' => [],
    'cdn' => [
        'backend' => 'local',
        'strategy' => 'md5',
        'adapters' => [
            'local' => [
                'type' => 'local',
                'mediaUrl' => '',
                'permissions' => [
                    'file' => [
                        'public' => 0666 & ~umask(),
                        'private' => 0600 & ~umask(),
                    ],
                    'dir' => [
                        'public' => 0777 & ~umask(),
                        'private' => 0700 & ~umask(),
                    ]
                ],
                'path' => realpath(__DIR__ . '/../../../')
            ],
            'ftp' => [
                'type' => 'ftp',
                'mediaUrl' => '',

                'host' => '',
                'username' => '',
                'password' => '',
                'port' => 21,
                'root' => '/',
                'passive' => true,
                'ssl' => false,
                'timeout' => 30
            ]
        ]
    ],
    'snippet' => [
        'readFromDb' => getenv('SWSNIPPET_READ_FROM_DB') == '1' ? true : false,
        'writeToDb' => getenv('SWSNIPPET_WRITE_TO_DB') == '1' ?  true : false,
        'readFromIni' => getenv('SWSNIPPET_READ_FROM_INI') == '1' ? true : false,
        'writeToIni' => getenv('SWSNIPPET_WRITE_TO_INI') == '1' ? true : false,
        'showSnippetPlaceholder' => getenv('SWSNIPPET_SHOW_SNIPPET_PLACE_HOLDER') == '1' ? true : false,
    ],
    'errorHandler' => [
        'throwOnRecoverableError' => false,
    ],
    'db' => [
        'username' => getenv('SWDB_USER'),
        'password' => getenv('SWDB_PASS'),
        'dbname' => getenv('SWDB_DATABASE'),
        'host' => getenv('SWDB_HOST'),
        'port' => getenv('SWDB_PORT'),
        'charset' => 'utf8',
        'adapter' => 'pdo_mysql'
    ],
    'es' => [
        'prefix' => 'sw_shop',
        'enabled' => false,
        'client' => [
            'hosts' => [
                'localhost:9200'
            ]
        ]
    ],
    'front' => [
        'noErrorHandler' => getenv('SWFRONT_NO_ERROR_HANDLER') == '1' ? true : false,
        'throwExceptions' => getenv('SWFRONT_THROW_EXCEPTIONS') == '1' ? true : false,
        'disableOutputBuffering' => getenv('SWFRONT_DISABLE_OUTPUT_BUFFERING') == '1' ? true : false,
        'showException' => getenv('SWFRONT_SHOW_EXCEPTION') == '1' ? true : false,
        'charset' => 'utf-8'
    ],
    'config' => [],
    'store' => [
        'apiEndpoint' => 'https://api.shopware.com',
    ],
    'plugins' => [],
    'template' => [
        'compileCheck' => true,
        'compileLocking' => true,
        'useSubDirs' => true,
        'forceCompile' => false,
        'useIncludePath' => true,
        'charset' => 'utf-8',
        'forceCache' => false,
        'cacheDir' => $this->getCacheDir().'/templates',
        'compileDir' => $this->getCacheDir().'/templates',
    ],
    'mail' => [
        'charset' => 'utf-8'
    ],
    'httpcache' => [
        'enabled' => true,
        'lookup_optimization' => true,
        'debug' => false,
        'default_ttl' => 0,
        'private_headers' => ['Authorization', 'Cookie'],
        'allow_reload' => false,
        'allow_revalidate' => false,
        'stale_while_revalidate' => 2,
        'stale_if_error' => false,
        'cache_dir' => $this->getCacheDir().'/html',
        'cache_cookies' => ['shop', 'currency', 'x-cache-context-hash'],
    ],
    'session' => [
        'name' => 'SHOPWARESID',
        'cookie_lifetime' => 0,
        //'cookie_httponly' => 1,
        'use_trans_sid' => false,
        'gc_probability' => 1,
        'gc_divisor' => 100,
        'save_handler' => 'db'
    ],
    'phpsettings' => [
        'error_reporting' => E_ALL,
        'display_errors' => 1,
        'date.timezone' => getenv('SWPHPSETTINGS_DATE_TIMEZONE'),
    ],
    'cache' => [
        'frontendOptions' => [
            'automatic_serialization' => true,
            'automatic_cleaning_factor' => 0,
            'lifetime' => 3600,
            'cache_id_prefix' => md5($this->getCacheDir())
        ],
        'backend' => 'auto', // e.G auto, apc, xcache
        'backendOptions' => [
            'hashed_directory_perm' => 0777 & ~umask(),
            'cache_file_perm' => 0666 & ~umask(),
            'hashed_directory_level' => 3,
            'cache_dir' => $this->getCacheDir().'/general',
            'file_name_prefix' => 'shopware'
        ],
    ],
    'hook' => [
        'proxyDir' => $this->getCacheDir().'/proxies',
        'proxyNamespace' => $this->App() . '_Proxies'
    ],
    'model' => [
        'autoGenerateProxyClasses' => false,
        'attributeDir' => $this->getCacheDir().'/doctrine/attributes',
        'proxyDir'     => $this->getCacheDir().'/doctrine/proxies',
        'proxyNamespace' => $this->App() . '\Proxies',
        'cacheProvider' => 'auto', // supports null, auto, Apc, Array, Wincache and Xcache
        'cacheNamespace' => null // custom namespace for doctrine cache provider (optional; null = auto-generated namespace)
    ],
    'backendsession' => [
        'name' => 'SHOPWAREBACKEND',
        //        'gc_maxlifetime' => 60 * 90,
        'cookie_lifetime' => 0,
        'cookie_httponly' => 1,
        'use_trans_sid' => false,
        'referer_check' => true,
        'client_check' => false // true or false (is not compatible with firebug)
    ],
], $customConfig);
