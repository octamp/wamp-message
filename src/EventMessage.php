<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\ArgumentsTrait;
use Octamp\Wamp\Message\Trait\DetailsTrait;

final class EventMessage extends Message implements WithDetailsInterface, WithArgumentsInterface
{
    use DetailsTrait;
    use ArgumentsTrait;

    public const CODE = 36;

    private int $subscriptionId;

    private int $publicationId;

    private ?string $topic;

    /**
     * Constructor
     *
     * @param int $subscriptionId
     * @param int $publicationId
     * @param \stdClass $details
     * @param mixed $arguments
     * @param mixed $argumentsKw
     * @param null $topic
     */
    public function __construct(
        int $subscriptionId,
        int $publicationId,
        array|object $details,
        ?array $arguments = null,
        array|object|null $argumentsKw = null,
        ?string $topic = null
    ) {
        $this->setArguments($arguments);
        $this->setArgumentsKw($argumentsKw);
        $this->setDetails($details);
        $this->setPublicationId($publicationId);
        $this->setSubscriptionId($subscriptionId);
        $this->topic = $topic;
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return array_merge([$this->getSubscriptionId(), $this->getPublicationId(), $this->getDetails()], $this->getArgumentsForSerialization());
    }

    public static function createFromPublishMessage(PublishMessage $msg, int $subscriptionId): EventMessage
    {
        return new EventMessage(
          $subscriptionId,
          $msg->getPublicationId(),
          new \stdClass(),
          $msg->getArguments(),
          $msg->getArgumentsKw(),
          $msg->getTopicName()
        );
    }

    public function setPublicationId(int $publicationId): void
    {
        $this->publicationId = $publicationId;
    }

    public function getPublicationId(): int
    {
        return $this->publicationId;
    }

    public function setSubscriptionId(int $subscriptionId): void
    {
        $this->subscriptionId = $subscriptionId;
    }

    public function getSubscriptionId(): int
    {
        return $this->subscriptionId;
    }

    public function isRestoringState(): bool
    {
        return isset($this->getDetails()->restoring_state) ? $this->getDetails()->restoring_state : false;
    }
}
