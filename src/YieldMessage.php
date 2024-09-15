<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\ArgumentsTrait;
use Octamp\Wamp\Message\Trait\OptionsTrait;
use Octamp\Wamp\Message\Trait\RequestTrait;

class YieldMessage extends Message implements WithRequestInterface, WithOptionsInterface, WithArgumentsInterface
{
    use RequestTrait;
    use OptionsTrait;
    use ArgumentsTrait;

    public const CODE = 70;

    public function __construct(int $requestId, array|object $options, ?array $arguments = null, array|object|null $argumentsKw = null)
    {
        $this->setRequestId($requestId);
        $this->setOptions($options);
        $this->setArguments($arguments);
        $this->setArgumentsKw($argumentsKw);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return array_merge([$this->getRequestId(), $this->getOptions()], $this->getArgumentsForSerialization());
    }
}
