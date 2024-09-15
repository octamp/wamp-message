<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\OptionsTrait;
use Octamp\Wamp\Message\Trait\RequestTrait;

final class RegisterMessage extends Message implements ActionMessageInterface, WithRequestInterface, WithOptionsInterface
{
    use RequestTrait;
    use OptionsTrait;

    public const CODE = 64;

    private string $procedureName;

    public function __construct(int $requestId, array|object $options, string $procedureName)
    {
        $this->setOptions($options);
        $this->setProcedureName(strtolower($procedureName));
        $this->setRequestId($requestId);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->requestId, $this->getOptions(), $this->getProcedureName()];
    }

    public function getProcedureName(): string
    {
        return $this->procedureName;
    }

    public function getUri(): string
    {
        return $this->getProcedureName();
    }

    public function getActionName(): string
    {
        return 'register';
    }

    public function setProcedureName(string $procedureName): void
    {
        $this->procedureName = $procedureName;
    }
}
