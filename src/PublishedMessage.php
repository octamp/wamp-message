<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\RequestTrait;

final class PublishedMessage extends Message implements WithRequestInterface
{
    use RequestTrait;

    public const CODE = 17;

    private int $publicationId;

    public function __construct(int $requestId, int $publicationId)
    {
        $this->setRequestId($requestId);
        $this->setPublicationId($publicationId);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function setPublicationId(int $publicationId): void
    {
        $this->publicationId = $publicationId;
    }

    public function getPublicationId(): int
    {
        return $this->publicationId;
    }

    public function getAdditionalMsgFields(): array
    {
        return [$this->getRequestId(), $this->getPublicationId()];
    }
}
