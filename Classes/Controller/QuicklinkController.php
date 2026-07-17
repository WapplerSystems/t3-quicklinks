<?php

declare(strict_types=1);

namespace Wapplersystems\WsQuicklinks\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Wapplersystems\WsQuicklinks\Domain\Repository\QuicklinkRepository;
use Wapplersystems\WsQuicklinks\Service\QuicklinkOrderService;

class QuicklinkController extends ActionController
{
    public function __construct(
        protected readonly QuicklinkRepository $quicklinkRepository,
        protected readonly QuicklinkOrderService $orderService,
    ) {
    }

    /**
     * Frontend list: shows the visitor's chosen quicklinks in their stored order.
     * Falls back to all quicklinks when nothing has been personalised yet.
     */
    public function listAction(): ResponseInterface
    {
        $allQuicklinks = $this->quicklinkRepository->findAll();
        $order = $this->orderService->getOrder($this->request);

        if ($order !== []) {
            $byUid = [];
            foreach ($allQuicklinks as $quicklink) {
                $byUid[$quicklink->getUid()] = $quicklink;
            }

            $quicklinks = [];
            foreach ($order as $uid) {
                if (isset($byUid[$uid])) {
                    $quicklinks[] = $byUid[$uid];
                }
            }
        } else {
            $quicklinks = $allQuicklinks;
        }

        $this->view->assign('quicklinks', $quicklinks);

        return $this->htmlResponse();
    }

    /**
     * Manager: splits quicklinks into the active (chosen, ordered) and the
     * remaining available ones so drag & drop starts from the stored state.
     */
    public function manageAction(): ResponseInterface
    {
        $allQuicklinks = $this->quicklinkRepository->findAll();
        $order = $this->orderService->getOrder($this->request);

        $byUid = [];
        foreach ($allQuicklinks as $quicklink) {
            $byUid[$quicklink->getUid()] = $quicklink;
        }

        $activeQuicklinks = [];
        foreach ($order as $uid) {
            if (isset($byUid[$uid])) {
                $activeQuicklinks[] = $byUid[$uid];
                unset($byUid[$uid]);
            }
        }

        $this->view->assignMultiple([
            'activeQuicklinks' => $activeQuicklinks,
            'availableQuicklinks' => array_values($byUid),
        ]);

        return $this->htmlResponse();
    }
}
