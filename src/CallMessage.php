<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\ArgumentsTrait;
use Octamp\Wamp\Message\Trait\OptionsTrait;
use Octamp\Wamp\Message\Trait\RequestTrait;

final class CallMessage extends Message implements ActionMessageInterface, WithRequestInterface, WithOptionsInterface, WithArgumentsInterface
{
    use RequestTrait;
    use OptionsTrait;
    use ArgumentsTrait;

    public const CODE = 48;

    private string $procedureName;

    public function __construct(int $requestId, array|object $options, string $procedureName, ?array $arguments = null, array|object|null $argumentsKw = null)
    {
        $this->setRequestId($requestId);
        $this->setOptions($options);
        $this->setProcedureName($procedureName);
        $this->setArguments($arguments);
        $this->setArgumentsKw($argumentsKw);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return array_merge([$this->getRequestId(), $this->getOptions(), $this->getProcedureName()], $this->getArgumentsForSerialization());
    }

    public function getProcedureName(): string
    {
        return $this->procedureName;
    }

    public function setProcedureName(string $procedureName): void
    {
        $this->procedureName = strtolower($procedureName);
    }

    public function getUri(): string
    {
        return $this->getProcedureName();
    }

    public function getActionName(): string
    {
        return 'call';
    }
}
