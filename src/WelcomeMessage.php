<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\DetailsTrait;

final class WelcomeMessage extends Message implements WithDetailsInterface
{
    use DetailsTrait;

    public const CODE = 2;

    private int $sessionId;

    public function __construct(int $sessionId, array|object $details)
    {
        $this->setDetails($details);
        $this->setSessionId($sessionId);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->sessionId, $this->details];
    }

    public function getSessionId(): int
    {
        return $this->sessionId;
    }

    public function setSessionId(int $sessionId): void
    {
        $this->sessionId = $sessionId;
    }
}
