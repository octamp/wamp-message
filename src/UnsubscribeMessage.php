<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\RequestTrait;

final class UnsubscribeMessage extends Message implements WithRequestInterface
{
    use RequestTrait;

    public const CODE = 34;

    private int $subscriptionId;

    public function __construct(int $requestId, int $subscriptionId)
    {
        $this->setRequestId($requestId);
        $this->setSubscriptionId($subscriptionId);
    }

    public function setSubscriptionId(int $subscriptionId): void
    {
        $this->subscriptionId = $subscriptionId;
    }

    public function getSubscriptionId(): int
    {
        return $this->subscriptionId;
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getRequestId(), $this->getSubscriptionId()];
    }
}
