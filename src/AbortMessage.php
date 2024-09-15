<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\DetailsTrait;

final class AbortMessage extends Message implements WithDetailsInterface
{
    use DetailsTrait;

    public const CODE = 3;

    public function __construct(array|object $details, private string $responseURI)
    {
        $this->setDetails($details);
    }

    public function getResponseURI(): string
    {
        return $this->responseURI;
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getDetails(), $this->getResponseURI()];
    }
}
