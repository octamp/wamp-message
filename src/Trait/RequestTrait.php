<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message\Trait;

trait RequestTrait
{
    private int $requestId;

    public function getRequestId(): int
    {
        return $this->requestId;
    }

    public function setRequestId(int $requestId): void
    {
        $this->requestId = $requestId;
    }
}