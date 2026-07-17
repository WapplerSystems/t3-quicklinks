<?php


use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die();

ExtensionUtility::registerPlugin(
    'ws_quicklinks',
    'List',
    'LLL:EXT:ws_quicklinks/Resources/Private/Language/locallang_db.xlf:plugin.list.title',
    'content-plugin',
);

ExtensionUtility::registerPlugin(
    'ws_quicklinks',
    'Manage',
    'LLL:EXT:ws_quicklinks/Resources/Private/Language/locallang_db.xlf:plugin.manage.title',
    'content-plugin',
);
