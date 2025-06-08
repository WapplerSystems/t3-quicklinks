<?php

namespace Wapplersystems\Quicklinks\Controller;

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
}
