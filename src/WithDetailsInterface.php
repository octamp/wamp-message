<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

interface WithDetailsInterface
{
    public function setDetails(array|object $details): void;

    public function getDetails(): object;

    public function addFeatures(string $name, object $features): void;
}