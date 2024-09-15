<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message\Trait;

trait ExtraTrait
{
    private ?object $extra = null;

    public function setExtra(array|object $extra): void
    {
        $this->extra = (object) $extra;
    }

    public function getExtra(): object
    {
        if ($this->extra === null) {
            $this->extra = new \stdClass();
        }

        return $this->extra;
    }
}