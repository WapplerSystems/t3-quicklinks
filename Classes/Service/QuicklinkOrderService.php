<?php

declare(strict_types=1);

namespace Wapplersystems\WsQuicklinks\Service;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Authentication\AbstractUserAuthentication;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Resolves and persists the personal quicklink order.
 *
 * Storage strategy:
 *  - logged-in frontend user -> fe_users.tx_wsquicklinks_order (persistent per user)
 *  - anonymous visitor        -> "quicklinks_order" cookie (set client-side by the manager JS)
 *
 * Reading always prefers the frontend user value and falls back to the cookie.
 */
class QuicklinkOrderService
{
    public const COOKIE_NAME = 'quicklinks_order';
    public const FE_USER_FIELD = 'tx_wsquicklinks_order';

    /**
     * Returns the stored order as a list of quicklink uids (may be empty).
     *
     * @return int[]
     */
    public function getOrder(ServerRequestInterface $request): array
    {
        $raw = '';

        $frontendUser = $this->getFrontendUser($request);
        if ($frontendUser !== null) {
            $raw = (string)($frontendUser[self::FE_USER_FIELD] ?? '');
        }

        if ($raw === '') {
            $cookies = $request->getCookieParams();
            $raw = (string)($cookies[self::COOKIE_NAME] ?? '');
        }

        return $this->parse($raw);
    }

    /**
     * Persists the order for a logged-in user in the fe_users record.
     * For anonymous visitors nothing is stored server-side – the cookie the
     * manager JS already set is authoritative.
     *
     * @param int[] $order
     * @return string 'user' when stored in the fe_users record, 'cookie' otherwise
     */
    public function saveOrder(ServerRequestInterface $request, array $order): string
    {
        $clean = implode(',', array_map('intval', $order));

        $frontendUserUid = $this->getFrontendUserUid($request);
        if ($frontendUserUid > 0) {
            GeneralUtility::makeInstance(ConnectionPool::class)
                ->getConnectionForTable('fe_users')
                ->update(
                    'fe_users',
                    [self::FE_USER_FIELD => $clean],
                    ['uid' => $frontendUserUid]
                );

            return 'user';
        }

        return 'cookie';
    }

    /**
     * @return int[]
     */
    private function parse(string $raw): array
    {
        return array_values(array_map('intval', GeneralUtility::trimExplode(',', $raw, true)));
    }

    private function getFrontendUser(ServerRequestInterface $request): ?array
    {
        $frontendUser = $request->getAttribute('frontend.user');
        if ($frontendUser instanceof AbstractUserAuthentication && !empty($frontendUser->user['uid'])) {
            return $frontendUser->user;
        }

        return null;
    }

    private function getFrontendUserUid(ServerRequestInterface $request): int
    {
        return (int)($this->getFrontendUser($request)['uid'] ?? 0);
    }
}
