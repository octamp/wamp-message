<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\DetailsTrait;

final class HelloMessage extends Message implements WithDetailsInterface
{
    use DetailsTrait;

    public const CODE = 1;

    private string $realm;

    private array $roles;

    private array $authMethods;

    public function __construct(string $realm, array|object $details)
    {
        $this->setDetails($details);
        $this->setRealm($realm);
        $authMethods = $details->authmethods ?? [];
        $this->setAuthMethods($authMethods);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getRealm(), $this->getDetails()];
    }

    public function setRealm(string $realm): void
    {
        $this->realm = $realm;
    }

    public function getRealm(): string
    {
        return $this->realm;
    }

    public function getAuthMethods(): array
    {
        return $this->authMethods;
    }

    public function setAuthMethods(array $authMethods): void
    {
        $this->authMethods = $authMethods;
    }
}