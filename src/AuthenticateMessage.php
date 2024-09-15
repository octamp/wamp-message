<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\ExtraTrait;

final class AuthenticateMessage extends Message implements WithExtraInterface
{
    use ExtraTrait;

    public const CODE = 5;

    private string $signature;

    public function __construct(string $signature, array|object $extra)
    {
        $this->setSignature($signature);
        $this->setExtra($extra);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getSignature(), $this->getExtra()];
    }

    public function getSignature(): string
    {
        return $this->signature;
    }

    public function setSignature(string $signature): void
    {
        $this->signature = $signature;
    }
}
