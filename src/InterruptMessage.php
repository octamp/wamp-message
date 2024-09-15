<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\OptionsTrait;
use Octamp\Wamp\Message\Trait\RequestTrait;

final class InterruptMessage extends Message implements WithRequestInterface, WithOptionsInterface
{
    use RequestTrait;
    use OptionsTrait;

    public const CODE = 69;

    public function __construct(int $requestId, array|object $options)
    {
        $this->setRequestId($requestId);
        $this->setOptions($options);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getRequestId(), $this->getOptions()];
    }
}
