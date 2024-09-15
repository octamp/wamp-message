<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

use Octamp\Wamp\Message\Trait\ArgumentsTrait;
use Octamp\Wamp\Message\Trait\DetailsTrait;

final class ErrorMessage extends Message implements WithDetailsInterface, WithArgumentsInterface
{
    use DetailsTrait;
    use ArgumentsTrait;

    public const CODE = 8;

    private int $errorMsgCode;

    private int $errorRequestId;

    private string $errorURI;

    public function __construct(int $errorMsgCode, int $errorRequestId, array|object $details, string $errorURI, ?array $arguments = null, array|object|null $argumentsKw = null)
    {
        $this->setErrorRequestId($errorRequestId);
        $this->setErrorMsgCode($errorMsgCode);
        $this->setDetails($details);
        $this->setErrorURI($errorURI);
        $this->setArguments($arguments);
        $this->setArgumentsKw($argumentsKw);
    }

    public function setErrorURI(string $errorURI): self
    {
        $this->errorURI = $errorURI;

        return $this;
    }

    public function getErrorURI(): string
    {
        return $this->errorURI;
    }

    public static function createErrorMessageFromMessage(Message $msg, ?string $errorUri = null): ErrorMessage
    {
        if ($errorUri === null) {
            $errorUri = 'wamp.error.unknown';
        }

        if ($msg instanceof WithRequestInterface) {
            return new ErrorMessage($msg->getMsgCode(), $msg->getRequestId(), new \stdClass, $errorUri);
        }

        throw new \InvalidArgumentException("Can't send an error message because the message didn't not have a request id ");
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        return array_merge([$this->getErrorMsgCode(), $this->getErrorRequestId(), $this->getDetails(), $this->getErrorURI()], $this->getArgumentsForSerialization());
    }

    public function setErrorMsgCode($errorMsgCode): ErrorMessage
    {
        $this->errorMsgCode = $errorMsgCode;

        return $this;
    }

    public function getErrorMsgCode(): int
    {
        return $this->errorMsgCode;
    }

    public function setRequestId(int $requestId): ErrorMessage
    {
        $this->errorRequestId = $requestId;

        return $this;
    }

    public function getRequestId(): int
    {
        return $this->errorRequestId;
    }

    public function setErrorRequestId(int $errorRequestId): ErrorMessage
    {
        $this->errorRequestId = $errorRequestId;

        return $this;
    }

    public function getErrorRequestId(): int
    {
        return $this->errorRequestId;
    }

    public function __toString(): string
    {
        return $this->getErrorURI();
    }
}
