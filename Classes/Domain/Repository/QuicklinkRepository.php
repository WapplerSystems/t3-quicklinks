<?php

declare(strict_types=1);

namespace Wapplersystems\WsQuicklinks\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * @extends Repository<\Wapplersystems\WsQuicklinks\Domain\Model\Quicklink>
 *
 * The storage folder holding the quicklink records is configured via
 * plugin.tx_wsquicklinks.persistence.storagePid (or the plugin's record
 * storage page), so the default storage-page handling is intentionally kept.
 */
class QuicklinkRepository extends Repository
{
}
