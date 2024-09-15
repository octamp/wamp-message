<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message\Trait;

trait ArgumentsTrait
{
    /**
     * @var mixed
     */
    private ?array $arguments = null;

    /**
     * @var mixed
     */
    private ?object $argumentsKw = null;

    /**
     * Get argument for serialization
     *
     * @return array
     */
    public function getArgumentsForSerialization(): array
    {
        $serialized = [];

        $args   = $this->getArguments();
        $argsKw = $this->getArgumentsKw();

        if ($args !== null && !empty($args)) {
            $serialized = [$args];
        }

        if ($argsKw !== null && !empty(get_object_vars($argsKw))) {
            $serialized = array_replace([[], $argsKw], $serialized);
        }

        return $serialized;
    }

    public function getArguments(): ?array
    {
        return $this->arguments;
    }

    public function setArguments(?array $arguments): void
    {
        $this->arguments = $arguments;
    }

    public function getArgumentsKw(): ?object
    {
        return $this->argumentsKw;
    }

    public function setArgumentsKw(array|object|null $argumentsKw): void
    {
        if ($argumentsKw === null) {
            $this->argumentsKw = $argumentsKw;
            return;
        }

        $this->argumentsKw = (object) $argumentsKw;
    }
}