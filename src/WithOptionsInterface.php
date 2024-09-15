<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

interface WithOptionsInterface
{
    public function getOptions(): object;

    public function setOptions(array|object $options): void;
}