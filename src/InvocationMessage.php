<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\ArgumentsTrait;
use Octamp\Wamp\Message\Trait\DetailsTrait;
use Octamp\Wamp\Message\Trait\RequestTrait;

final class InvocationMessage extends Message implements WithRequestInterface, WithDetailsInterface, WithArgumentsInterface
{
    use RequestTrait;
    use DetailsTrait;
    use ArgumentsTrait;

    public const CODE = 68;

    private int $registrationId;

    public function __construct(int $requestId, int $registrationId, array|object $details, ?array $arguments = null, array|object|null $argumentsKw = null)
    {
        $this->setRequestId($requestId);
        $this->setRegistrationId($registrationId);
        $this->setDetails($details);
        $this->setArguments($arguments);
        $this->setArgumentsKw($argumentsKw);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return array_merge([$this->getRequestId(), $this->getRegistrationId(), $this->getDetails()], $this->getArgumentsForSerialization());
    }

    public function getRegistrationId(): int
    {
        return $this->registrationId;
    }

    public function setRegistrationId(int $registrationId): void
    {
        $this->registrationId = $registrationId;
    }
}
