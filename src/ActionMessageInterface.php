<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

interface ActionMessageInterface
{
    public function getUri(): string;

    /**
     * This returns the action name "publish", "subscribe", "register", "call"
     *
     * @return string
     */
    public function getActionName(): string;
}
