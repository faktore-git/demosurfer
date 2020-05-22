<?php
return [
    'BE' => [
        'compressionLevel' => '0',
        'debug' => '',
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => 'definedInAdditionalConfiguration',
        'loginSecurityLevel' => 'rsa',
        'versionNumberInFilename' => '0',
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8',
                'dbname' => 'vagrant',
                'driver' => 'mysqli',
                'host' => 'localhost',
                'password' => 'vagrant',
                'port' => 3306,
                'user' => 'vagrant',
            ],
        ],
        'extTablesDefinitionScript' => 'extTables.php',
    ],
    'EXT' => [
        'extConf' => [
        ],
    ],
    'FE' => [
        'cacheHash' => [
            'cachedParametersWhiteList' => [],
        ],
        'compressionLevel' => '0',
        'debug' => '',
        'hidePagesIfNotTranslatedByDefault' => '1',
        'loginSecurityLevel' => 'rsa',
        'pageNotFoundOnCHashError' => '0',
        'pageNotFound_handling' => 'REDIRECT:404',
    ],
    'GFX' => [
        'gdlib_png' => '1',
        'jpg_quality' => '100',
        'processor' => 'ImageMagick',
        'processor_allowTemporaryMasksAsPng' => false,
        'processor_colorspace' => 'sRGB',
        'processor_effects' => true,
        'processor_enabled' => 1,
        'processor_path' => '/usr/bin/',
        'processor_path_lzw' => '/usr/bin/',
    ],
    'HTTP' => [],
    'INSTALL' => [],
    'MAIL' => [
        'defaultMailFromAddress' => 'info@localhost',
        'defaultMailFromName' => 'TYPO3 demosurfer',
    ],
    'SYS' => [
        'UTF8filesystem' => '1',
        'caching' => [
            'cacheConfigurations' => [
                'extbase_object' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
                    'groups' => [
                        'system',
                    ],
                    'options' => [
                        'defaultLifetime' => 0,
                    ],
                ],
            ],
        ],
        'devIPmask' => '',
        'displayErrors' => '0',
        'encryptionKey' => '140746fa8ddb0ad3a4fc891ffba45ecfdf47cfde525535fbd0c9b3524d48de751960725958352c2889a7ee7134a57740',
        'features' => [
            'unifiedPageTranslationHandling' => true,
        ],
        'sitename' => 'TYPO3',
        'systemLogLevel' => '2',
    ],
];
