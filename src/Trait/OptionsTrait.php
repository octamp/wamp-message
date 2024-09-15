<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message\Trait;

trait OptionsTrait
{
    private ?object $options = null;

    public function getOptions(): object
    {
        if ($this->options === null) {
            $this->options = new \stdClass();
        }

        return $this->options;
    }

    public function setOptions(array|object $options): void
    {
        $this->options = (object) $options;
    }
}