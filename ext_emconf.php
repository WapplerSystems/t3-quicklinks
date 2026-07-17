<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Frontend Quicklinks',
    'description' => 'Frontend quicklinks with a drag & drop manager. The personal order is stored in the frontend user record when logged in, otherwise in a cookie.',
    'category' => 'fe',
    'state' => 'beta',
    'author' => 'Sven Wappler',
    'author_email' => 'typo3@wappler.systems',
    'author_company' => 'WapplerSystems',
    'version' => '0.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '14.0.0-14.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];