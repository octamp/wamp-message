<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message\Trait;

trait DetailsTrait
{
    private ?object $details = null;

    public function setDetails(array|object $details): void
    {
        $this->details = (object) $details;
    }

    public function getDetails(): object
    {
        if ($this->details === null) {
            $this->details = new \stdClass();
        }

        return $this->details;
    }

    public function addFeatures(string $name, object $features): void
    {
        $this->details = $this->details !== null ? $this->details : new \stdClass();
        $this->details->roles = $this->details->roles ?? new \stdClass();

        $this->details->roles->$name = (object)['features' => $features];
    }
}