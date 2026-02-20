<?php

namespace Wapplersystems\WsQuicklinks\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Wapplersystems\WsQuicklinks\Domain\Repository\QuicklinkRepository;

class QuicklinkController extends ActionController
{
    protected QuicklinkRepository $quicklinkRepository;

    public function __construct(QuicklinkRepository $quicklinkRepository)
    {
        $this->quicklinkRepository = $quicklinkRepository;
    }

    public function listAction(): ResponseInterface
    {
        $quicklinks = $this->quicklinkRepository->findAll();

        // Cookie quicklinks_order auslesen
        $cookieValue = $_COOKIE['quicklinks_order'] ?? '';
        if (!empty($cookieValue)) {
            // IDs aus dem Cookie extrahieren (angenommen: Komma-getrennte Liste)
            $orderedIds = array_filter(array_map('trim', explode(',', $cookieValue)));
            if (!empty($orderedIds)) {
                // Quicklinks nach IDs filtern und sortieren
                $quicklinksById = [];
                foreach ($quicklinks as $quicklink) {
                    $quicklinksById[$quicklink->getUid()] = $quicklink;
                }
                $sortedQuicklinks = [];
                foreach ($orderedIds as $id) {
                    if (isset($quicklinksById[$id])) {
                        $sortedQuicklinks[] = $quicklinksById[$id];
                    }
                }
                $quicklinks = $sortedQuicklinks;
            }
        }
        $this->view->assign('quicklinks', $quicklinks);

        return $this->htmlResponse();
    }


    public function manageAction(): ResponseInterface
    {
        $quicklinks = $this->quicklinkRepository->findAll();
        $this->view->assign('quicklinks', $quicklinks);

        return $this->htmlResponse();
    }

}
