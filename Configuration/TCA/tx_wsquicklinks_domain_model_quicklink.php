<?php

return [
    'ctrl' => [
        'title' => 'Quicklink',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'start' => 'starttime',
            'end' => 'endtime',
        ],
        'iconfile' => 'EXT:ws_quicklinks/Resources/Public/Icons/quicklink.svg',
    ],
    'columns' => [
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ],
        ],
        'icon' => [
            'label' => 'Icon',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
            ],
        ],
        'link' => [
            'label' => 'Link',
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
