<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message\Factory;

use Octamp\Wamp\Message\Message;

interface MessageFactoryInterface
{
    public static function createMessage(array $data): Message;
}