<?php

use Wapplersystems\WsQuicklinks\Middleware\QuicklinkSaveMiddleware;

return [
    'frontend' => [
        'wapplersystems/quicklinks/save' => [
            'target' => QuicklinkSaveMiddleware::class,
            'after' => [
                'typo3/cms-frontend/authentication',
            ],
            'before' => [
                'typo3/cms-frontend/page-resolver',
            ],
        ],
    ],
];
