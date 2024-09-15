<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\RequestTrait;

final class UnsubscribedMessage extends Message implements WithRequestInterface
{
    use RequestTrait;

    public const CODE = 35;

    public function __construct(int $requestId)
    {
        $this->setRequestId($requestId);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getRequestId()];
    }
}
