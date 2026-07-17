<?php

declare(strict_types=1);

namespace Wapplersystems\WsQuicklinks\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Wapplersystems\WsQuicklinks\Service\QuicklinkOrderService;

/**
 * Lightweight AJAX endpoint for persisting the quicklink order.
 *
 * Triggered by POST requests carrying "tx_wsquicklinks_save=1". It runs right
 * after frontend user authentication (so the fe_user is known) and before the
 * page/cHash handling, short-circuiting the request with a small JSON response
 * instead of rendering a whole page.
 */
class QuicklinkSaveMiddleware implements MiddlewareInterface
{
    private const TRIGGER_PARAM = 'tx_wsquicklinks_save';

    public function __construct(
        private readonly QuicklinkOrderService $orderService,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        if (($queryParams[self::TRIGGER_PARAM] ?? null) !== '1' || $request->getMethod() !== 'POST') {
            return $handler->handle($request);
        }

        $body = $request->getParsedBody();
        $rawOrder = is_array($body) ? (string)($body['order'] ?? '') : '';
        $order = GeneralUtility::intExplode(',', $rawOrder, true);

        $storage = $this->orderService->saveOrder($request, $order);

        return new JsonResponse([
            'status' => 'ok',
            'storage' => $storage,
        ]);
    }
}
