<?php
defined('TYPO3') or die();

use \TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Wapplersystems\WsQuicklinks\Controller\QuicklinkController;

ExtensionUtility::configurePlugin(
    'ws_quicklinks',
    'List',
    [
        QuicklinkController::class => 'list',
    ],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
    'ws_quicklinks',
    'Manage',
    [
        QuicklinkController::class => 'manage',
    ],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
