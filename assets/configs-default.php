<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

use Shopware\Components\Logger;

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

    /*
     * For more information on working with reverse proxies and trusted headers see
     * https://symfony.com/doc/current/deployment/proxies.html
     */
    'trustedproxies' => [],
    'trustedheaderset' => -1,

    'filesystem' => [
        'private' => [
            'type' => 'local',
            'config' => [
                'root' => realpath(__DIR__ . '/../../../files/'),
            ],
        ],
        'public' => [
            'type' => 'local',
            'config' => [
                'root' => realpath(__DIR__ . '/../../../web/'),
                'url' => '',
            ],
        ],
    ],
    'cdn' => [
        'backend' => 'local',
        'strategy' => 'md5',
        'liveMigration' => false,
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
                    ],
                ],
                'root' => realpath(__DIR__ . '/../../../'),
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
                'timeout' => 30,
            ],
            's3' => [
                'type' => 's3',
                'mediaUrl' => '',

                'bucket' => '',
                'region' => '',
                'endpoint' => null,
                'credentials' => [
                    'key' => '',
                    'secret' => '',
                ],
            ],
            'gcp' => [
                'type' => 'gcp',
                'mediaUrl' => '',

                'projectId' => '',
                'keyFilePath' => '',
                'bucket' => '',
                'root' => '',
            ],
        ],
    ],
    'csrfProtection' => [
        'frontend' => getenv('SWCSRFPROTECTION_FRONTEND') == '1' ? true : false,
        'backend' => getenv('SWCSRFPROTECTION_BACKEND') == '1' ? true : false,
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
        'charset' => 'utf8',
        'adapter' => 'pdo_mysql',
    ],
    'es' => [
        'prefix' => getenv('SWES_PREFIX') ? getenv('SWES_PREFIX') : 'sw_shop',
        'enabled' => getenv('SWES_ENABLED') == '1' ? true : false,
        'write_backlog' => getenv('SWES_WRITE_BACKLOG') == '1' ? true : false,
        'number_of_replicas' => getenv('SWES_NUM_REPLICAS') ? getenv('SWES_NUM_REPLICAS') : null,
        'number_of_shards' => getenv('SWES_NUM_SHARDS') ? getenv('SWES_NUM_SHARDS') : null,
        'total_fields_limit' => null,
        'max_result_window' => 10000,
        'wait_for_status' => 'green',
        'dynamic_mapping_enabled' => true,
        'batchsize' => 500,
        'backend' => [
            'write_backlog' => false,
            'enabled' => false,
        ],
        'client' => [
            'hosts' => [
                getenv('SWES_HOST') ? getenv('SWES_HOST') : 'localhost:9200',
            ],
        ],
        'logger' => [
            'level' => $this->Environment() !== 'production' ? Logger::DEBUG : Logger::ERROR,
        ],
        'max_expansions' => [
            'name' => 2,
            'number' => 2,
        ],
    ],
    'front' => [
        'noErrorHandler' => getenv('SWFRONT_NO_ERROR_HANDLER') == '1' ? true : false,
        'throwExceptions' => getenv('SWFRONT_THROW_EXCEPTIONS') == '1' ? true : false,
        'disableOutputBuffering' => getenv('SWFRONT_DISABLE_OUTPUT_BUFFERING') == '1' ? true : false,
        'showException' => getenv('SWFRONT_SHOW_EXCEPTION') == '1' ? true : false,
        'charset' => getenv('SWFRONT_CHARSET'),
    ],
    'config' => [],
    'store' => [
        'apiEndpoint' => 'https://api.shopware.com',
        'timeout' => 7,
        'connect_timeout' => 5,
    ],
    'plugin_directories' => [
        'Default' => $this->AppPath('Plugins_Default'),
        'Local' => $this->AppPath('Plugins_Local'),
        'Community' => $this->AppPath('Plugins_Community'),
        'ShopwarePlugins' => $this->DocPath('custom_plugins'),
        'ProjectPlugins' => $this->DocPath('custom_project'),
    ],
    'template' => [
        'compileCheck' => true,
        'compileLocking' => true,
        'useSubDirs' => true,
        'forceCompile' => false,
        'useIncludePath' => true,
        'charset' => 'utf-8',
        'forceCache' => false,
        'cacheDir' => $this->getCacheDir() . '/templates',
        'compileDir' => $this->getCacheDir() . '/templates',
        'templateDir' => $this->DocPath('themes'),
    ],
    'mail' => [
        'charset' => 'utf-8',
    ],
    'httpcache' => [
        'enabled' => getenv('SWHTTPCACHE_ENABLED') == '1' ? true : false,
        'lookup_optimization' => getenv('SWHTTPCACHE_LOOKUP_OPTIMIZATION') == '1' ? true : false,
        'debug' => getenv('SWHTTPCACHE_DEBUG') == '1' ? true : false,
        'default_ttl' => getenv('SWHTTPCACHE_DEFAULT_TTL'),
        'private_headers' => ['Authorization', 'Cookie'],
        'allow_reload' => getenv('SWHTTPCACHE_ALLOW_RELOAD') == '1' ? true : false,
        'allow_revalidate' => getenv('SWHTTPCACHE_ALLOW_REVALIDATE') == '1' ? true : false,
        'stale_while_revalidate' => getenv('SWHTTPCACHE_STALE_WHILE_REVALIDATE'),
        'stale_if_error' => getenv('SWHTTPCACHE_STALE_IF_ERROR') == '1' ? true : false,
        'cache_dir' => $this->getCacheDir() . '/html',
        'cache_cookies' => explode('|', getenv('SWHTTPCACHE_CACHE_COOKIES')),
        /*
         * The "ignored_url_parameters" configuration will spare your Shopware system from re-caching a page when any
         * of the parameters listed here is matched. This allows the caching system to be more efficient.
         */
        'ignored_url_parameters' => [
            'pk_campaign',    // Piwik
            'piwik_campaign',
            'pk_kwd',
            'piwik_kwd',
            'pk_keyword',
            'pixelId',        // Yahoo
            'kwid',
            'kw',
            'adid',
            'chl',
            'dv',
            'nk',
            'pa',
            'camid',
            'adgid',
            'utm_term',       // Google
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_content',
            'gclid',
            'cx',
            'ie',
            'cof',
            'siteurl',
            '_ga',
            'fbclid',         // Facebook
        ],
    ],
    'bi' => [
        'endpoint' => [
            'benchmark' => 'https://bi.shopware.com/benchmark',
            'statistics' => 'https://bi.shopware.com/statistics',
        ],
    ],
    'session' => [
        'cookie_lifetime' => 0,
        'cookie_httponly' => 1,
        'gc_probability' => 1,
        'gc_divisor' => 200,
        'save_handler' => 'db',
        'use_trans_sid' => 0,
        'locking' => true,
    ],
    'sitemap' => [
        'batchsize' => 10000,
        'excluded_urls' => [],
        'custom_urls' => [],
    ],
    'phpsettings' => [
        'error_reporting' => E_ALL & ~E_USER_DEPRECATED,
        'display_errors' => getenv('SWPHPSETTINGS_DISPLAY_ERRORS'),
        'date.timezone' => getenv('SWPHPSETTINGS_DATE_TIMEZONE'),
    ],
    'cache' => [
        'frontendOptions' => [
            'automatic_serialization' => true,
            'automatic_cleaning_factor' => 0,
            'lifetime' => 3600,
            'cache_id_prefix' => md5($this->getCacheDir()),
        ],
        'backend' => 'auto', // e.G auto, apcu, xcache, redis
        'backendOptions' => [
            'hashed_directory_perm' => 0777 & ~umask(),
            'cache_file_perm' => 0666 & ~umask(),
            'hashed_directory_level' => 3,
            'cache_dir' => $this->getCacheDir() . '/general',
            'file_name_prefix' => 'shopware',
        ],
    ],
    'hook' => [
        'proxyDir' => $this->getCacheDir() . '/proxies',
        'proxyNamespace' => $this->App() . '_Proxies',
    ],
    'model' => [
        'autoGenerateProxyClasses' => false,
        'attributeDir' => $this->getCacheDir() . '/doctrine/attributes',
        'proxyDir' => $this->getCacheDir() . '/doctrine/proxies',
        'proxyNamespace' => $this->App() . '\Proxies',
        'cacheProvider' => 'auto', // Supports null, auto, Apcu, Array, Wincache, Xcache and redis
        'cacheNamespace' => null, // Custom namespace for doctrine cache provider (optional; null = auto-generated namespace)
        'validOperators' => [], // Additional allowed QueryBuilder operators
    ],
    'backendsession' => [
        'name' => 'SHOPWAREBACKEND',
        'cookie_lifetime' => 0,
        'cookie_httponly' => 1,
        'use_trans_sid' => 0,
        'locking' => false,
    ],
    'template_security' => [
        'php_modifiers' => include __DIR__ . '/smarty_functions.php',
        'php_functions' => include __DIR__ . '/smarty_functions.php',
    ],
    'search' => [
        'indexer' => [
            'batchsize' => 4000,
        ],
    ],
    'app' => [
        'rootDir' => $this->DocPath(),
        'downloadsDir' => $this->DocPath('files_downloads'),
        'documentsDir' => $this->DocPath('files_documents'),
    ],
    'web' => [
        'webDir' => $this->DocPath('web'),
        'cacheDir' => $this->DocPath('web_cache'),
    ],
    'mpdf' => [
        // Passed to \Mpdf\Mpdf::__construct:
        'defaultConfig' => [
            'tempDir' => $this->getCacheDir() . '/mpdf/',
            'fontDir' => $this->DocPath('engine_Library_Mpdf_ttfonts_'),
            'fonttrans' => [
                'helvetica' => 'arial',
                'verdana' => 'arial',
                'times' => 'timesnewroman',
                'courier' => 'couriernew',
                'trebuchet' => 'arial',
                'comic' => 'arial',
                'franklin' => 'arial',
                'albertus' => 'arial',
                'arialuni' => 'arial',
                'zn_hannom_a' => 'arial',
                'ocr-b' => 'ocrb',
                'ocr-b10bt' => 'ocrb',
                'damase' => 'mph2bdamase',
            ],
            'fontdata' => [
                'arial' => [
                    'R' => 'arial.ttf',
                    'B' => 'arialbd.ttf',
                    'I' => 'ariali.ttf',
                    'BI' => 'arialbi.ttf',
                ],
                'couriernew' => [
                    'R' => 'cour.ttf',
                    'B' => 'courbd.ttf',
                    'I' => 'couri.ttf',
                    'BI' => 'courbi.ttf',
                ],
                'georgia' => [
                    'R' => 'georgia.ttf',
                    'B' => 'georgiab.ttf',
                    'I' => 'georgiai.ttf',
                    'BI' => 'georgiaz.ttf',
                ],
                'timesnewroman' => [
                    'R' => 'times.ttf',
                    'B' => 'timesbd.ttf',
                    'I' => 'timesi.ttf',
                    'BI' => 'timesbi.ttf',
                ],
                'verdana' => [
                    'R' => 'verdana.ttf',
                    'B' => 'verdanab.ttf',
                    'I' => 'verdanai.ttf',
                    'BI' => 'verdanaz.ttf',
                ],
            ],
            'format' => 'A4',
        ],
    ],
    'backward_compatibility' => [
        /*
         * @deprecated since Shopware 5.5
         *
         * Sorting of plugins is active by default in 5.6 and this parameter will be removed with Shopware 5.7
         */
        'predictable_plugin_order' => true,
    ],
    'logger' => [
        'level' => $this->Environment() !== 'production' ? Logger::DEBUG : Logger::ERROR,
    ],
], $customConfig);
