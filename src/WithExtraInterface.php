<?php

namespace Octamp\Wamp\Message;

interface WithExtraInterface
{
    public function setExtra(array|object $extra): void;

    public function getExtra(): object;
}