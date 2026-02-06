<?php

namespace Wapplersystems\Quicklinks\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Wapplersystems\Quicklinks\Domain\Repository\QuicklinkRepository;

class QuicklinkController extends ActionController
{
    protected QuicklinkRepository $quicklinkRepository;

    public function __construct(QuicklinkRepository $quicklinkRepository)
    {
        $this->quicklinkRepository = $quicklinkRepository;
    }

    public function listAction(): void
    {
        $quicklinks = $this->quicklinkRepository->findAll();
        $this->view->assign('quicklinks', $quicklinks);
    }


    public function manageAction(): ResponseInterface
    {
        $quicklinks = $this->quicklinkRepository->findAll();
        $cookieQuicklinks = $this->request->getCookieParams()['quicklinks_order'] ?? null;

        if ($cookieQuicklinks) {
            $orderedQuicklinks = [];
            $order = explode(',', $cookieQuicklinks);

            foreach ($order as $quicklinkId) {
                foreach ($quicklinks as $quicklink) {
                    if ($quicklink->getUid() === $quicklinkId) {
                        $orderedQuicklinks[] = $quicklink;
                        break;
                    }
                }
            }

            $quicklinks = $orderedQuicklinks;
        }

        $this->view->assign('quicklinks', $quicklinks);

        return $this->htmlResponse();
    }

}
