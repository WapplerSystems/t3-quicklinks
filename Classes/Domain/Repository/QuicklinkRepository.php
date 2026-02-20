<?php


namespace Wapplersystems\WsQuicklinks\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class QuicklinkRepository extends Repository
{

    public function createQuery()
    {

        $query = parent::createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        return $query;
    }

}
