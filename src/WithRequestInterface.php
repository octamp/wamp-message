<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

interface WithRequestInterface
{
    public function getRequestId(): int;

    public function setRequestId(int $requestId): void;
}