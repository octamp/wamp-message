<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\RequestTrait;

final class UnregisterMessage extends Message implements WithRequestInterface
{
    use RequestTrait;

    public const CODE = 66;

    private int $registrationId;

    public function __construct(int $requestId, int $registrationId)
    {
        $this->setRegistrationId($registrationId);
        $this->setRequestId($requestId);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getRequestId(), $this->getRegistrationId()];
    }

    public function getRegistrationId(): int
    {
        return $this->registrationId;
    }

    public function setRegistrationId($registrationId): void
    {
        $this->registrationId = $registrationId;
    }
}
