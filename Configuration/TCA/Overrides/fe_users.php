<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

// Stores the personal quicklink order (comma-separated uid list) for logged-in
// frontend users. Written by the "save" plugin action, not edited by hand, so
// it is registered read-only and placed on an "Extended" tab.
$quicklinksColumns = [
    'tx_wsquicklinks_order' => [
        'exclude' => true,
        'label' => 'LLL:EXT:ws_quicklinks/Resources/Private/Language/locallang_db.xlf:fe_users.tx_wsquicklinks_order',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'readOnly' => true,
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns('fe_users', $quicklinksColumns);
ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'tx_wsquicklinks_order',
    '',
    'after:lockToDomain'
);
