<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\ArgumentsTrait;
use Octamp\Wamp\Message\Trait\OptionsTrait;
use Octamp\Wamp\Message\Trait\RequestTrait;

final class PublishMessage extends Message implements ActionMessageInterface, WithRequestInterface, WithOptionsInterface, WithArgumentsInterface
{
    use RequestTrait;
    use OptionsTrait;
    use ArgumentsTrait;

    public const CODE = 16;

    private string $topicName;

    private ?int $publicationId = null;

    public function __construct(int $requestId, array|object $options, string $topicName, ?array $arguments = null, array|object|null $argumentsKw = null)
    {
        $this->setRequestId($requestId);
        $this->setArguments($arguments);
        $this->setArgumentsKw($argumentsKw);
        $this->setOptions($options);
        $this->setTopicName($topicName);
    }

    public function getMsgCode(): int
    {
        return static::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return array_merge([$this->getRequestId(), $this->getOptions(), $this->getTopicName()], $this->getArgumentsForSerialization());
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
        return 'publish';
    }

    public function getPublicationId(): ?int
    {
        return $this->publicationId;
    }

    public function setPublicationId(int $publicationId): void
    {
        $this->publicationId = $publicationId;
    }
}
