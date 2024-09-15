<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\OptionsTrait;
use Octamp\Wamp\Message\Trait\RequestTrait;

final class SubscribeMessage extends Message implements ActionMessageInterface, WithOptionsInterface, WithRequestInterface
{
    use RequestTrait;
    use OptionsTrait;

    public const CODE = 32;

    private string $topicName;

    public function __construct(int $requestId, array|object $options, string $topicName)
    {
        $this->setOptions($options);
        $this->setTopicName($topicName);
        $this->setRequestId($requestId);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getRequestId(), $this->getOptions(), $this->getTopicName()];
    }

    public function setTopicName(string $topicName): void
    {
        $this->topicName = $topicName;
    }

    public function getTopicName(): string
    {
        return $this->topicName;
    }

    public function getUri(): string
    {
        return $this->getTopicName();
    }

    public function getActionName(): string
    {
        return 'subscribe';
    }

    public function getMatchType(): string
    {
        return static::getMatchTypeFromOption($this->getOptions());
    }

    public function setMatchType(string $matchType): void
    {
        $options = $this->getOptions();
        $options->match = $matchType;

        $this->setOptions($options);
    }

    static public function getMatchTypeFromOption(object $options): string
    {
        if (isset($options->match) && is_string($options->match)) {
            return $options->match;
        }

        return 'exact';
    }
}
