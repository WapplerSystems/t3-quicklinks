<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:ws_quicklinks/Resources/Private/Language/locallang_db.xlf:tx_wsquicklinks_domain_model_quicklink',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'start' => 'starttime',
            'end' => 'endtime',
        ],
        'iconfile' => 'EXT:ws_quicklinks/Resources/Public/Icons/Extension.svg',
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:ws_quicklinks/Resources/Private/Language/locallang_db.xlf:tx_wsquicklinks_domain_model_quicklink.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ],
        ],
        'icon' => [
            'label' => 'LLL:EXT:ws_quicklinks/Resources/Private/Language/locallang_db.xlf:tx_wsquicklinks_domain_model_quicklink.icon',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'maxitems' => 1,
            ],
        ],
        'link' => [
            'label' => 'LLL:EXT:ws_quicklinks/Resources/Private/Language/locallang_db.xlf:tx_wsquicklinks_domain_model_quicklink.link',
            'config' => [
                'type' => 'link',
                'allowedTypes' => ['page', 'url', 'record'],
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'name, icon, link'],
    ],
];
