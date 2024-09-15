<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\RequestTrait;

final class UnregisteredMessage extends Message implements WithRequestInterface
{
    use RequestTrait;

    public const CODE = 67;

    public function __construct(int $requestId)
    {
        $this->requestId = $requestId;
    }

    public static function createFromUnregisterMessage(UnregisterMessage $msg): UnregisteredMessage
    {
        return new UnregisteredMessage($msg->getRequestId());
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
