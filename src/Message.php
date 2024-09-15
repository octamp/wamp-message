<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

abstract class Message
{
    abstract public function getMsgCode(): int;

    abstract public function getAdditionalMsgFields(): array;

    public function getMessageParts(): array
    {
        return array_merge([$this->getMsgCode()], $this->getAdditionalMsgFields());
    }

    public function jsonSerialize() : array
    {
        return $this->getMessageParts();
    }

    public function __toString(): string
    {
        return '[' . get_class($this) . ']';
    }

    public static function shouldBeDictionary(array|object $data): object
    {
        if (is_array($data)) {
            return (object) $data;
        }

        return $data;
    }

    public static function isAssoc(object|array $arr): bool
    {
        $arr = (array) $arr;

        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}