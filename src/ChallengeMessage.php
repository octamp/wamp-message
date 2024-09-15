<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\ExtraTrait;

final class ChallengeMessage extends Message implements WithExtraInterface
{
    use ExtraTrait;

    public const CODE = 4;

    private string $authMethod;

    public function __construct(string $authMethod, array|object $extra)
    {
        $this->setAuthMethod($authMethod);
        $this->setExtra($extra);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getAuthMethod(), $this->getExtra()];
    }

    public function getAuthMethod(): string
    {
        return $this->authMethod;
    }

    public function setAuthMethod(string $authMethod): void
    {
        $this->authMethod = $authMethod;
    }
}
