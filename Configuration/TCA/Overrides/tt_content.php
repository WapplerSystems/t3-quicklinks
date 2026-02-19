<?php


use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die();

ExtensionUtility::registerPlugin(
    'ws_quicklinks',
    'List',
    'Quicklinks list',
    'content-plugin',
);

ExtensionUtility::registerPlugin(
    'ws_quicklinks',
    'Manage',
    'Quicklinks manager',
    'content-plugin',
);
