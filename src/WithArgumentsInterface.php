<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

interface WithArgumentsInterface
{
    public function getArgumentsForSerialization(): array;

    /**
     * Get arguments
     *
     * @return mixed
     */
    public function getArguments(): ?array;

    /**
     * Set arguments
     *
     * @param mixed $arguments
     */
    public function setArguments(?array $arguments): void;

    /**
     * Get arguments kw
     *
     * @return mixed
     */
    public function getArgumentsKw(): ?object;

    /**
     * Set arguments
     *
     * @param mixed $argumentsKw
     */
    public function setArgumentsKw(array|object|null $argumentsKw): void;
}