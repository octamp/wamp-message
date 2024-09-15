<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\DetailsTrait;

final class GoodbyeMessage extends Message implements WithDetailsInterface
{
    use DetailsTrait;

    public const CODE = 6;

    private string $reason;

    public function __construct(array|object $details, string $reason)
    {
        $this->setDetails($details);
        $this->setReason($reason);
    }

    public function setReason(string $reason): void
    {
        $this->reason = $reason;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getDetails(), $this->getReason()];
    }
}
