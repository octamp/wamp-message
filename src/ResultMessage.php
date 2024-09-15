<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\ArgumentsTrait;
use Octamp\Wamp\Message\Trait\DetailsTrait;
use Octamp\Wamp\Message\Trait\RequestTrait;

final class ResultMessage extends Message implements WithRequestInterface, WithDetailsInterface, WithArgumentsInterface
{
    use RequestTrait;
    use DetailsTrait;
    use ArgumentsTrait;

    public const CODE = 50;

    public function __construct(int $requestId, array|object $details, ?array $arguments = null, array|object $argumentsKw = null)
    {
        $this->setRequestId($requestId);
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
        return array_merge([$this->getRequestId(), $this->getDetails()], $this->getArgumentsForSerialization());
    }
}
