<?php
defined('TYPO3') or die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Wapplersystems\WsQuicklinks\Controller\QuicklinkController;

// The output is personalised per visitor (cookie / fe_user order), so every
// action is registered as non-cacheable (USER_INT) – otherwise the first
// visitor's order would be frozen into the page cache for everyone.
ExtensionUtility::configurePlugin(
    'ws_quicklinks',
    'List',
    [
        QuicklinkController::class => 'list',
    ],
    [
        QuicklinkController::class => 'list',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
    'ws_quicklinks',
    'Manage',
    [
        QuicklinkController::class => 'manage',
    ],
    [
        QuicklinkController::class => 'manage',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
