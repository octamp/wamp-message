<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

final class HeartbeatMessage extends Message
{
    public const CODE = 7;

    private int $incomingSeq;

    private int $outgoingSeq;

    private string $discard;

    public function __construct($incomingSeq, $outgoingSeq, $discard = null)
    {
        $this->setDiscard($discard);
        $this->setIncomingSeq($incomingSeq);
        $this->setOutgoingSeq($outgoingSeq);
    }

    public function getMsgCode(): int
    {
        return self::CODE;
    }

    public function getAdditionalMsgFields(): array
    {
        $fields = [$this->getIncomingSeq(), $this->getOutgoingSeq()];

        if (is_string($this->getDiscard())) {
            $fields[] = $this->getDiscard();
        }

        return $fields;
    }

    public function getDiscard(): string
    {
        return $this->discard;
    }

    public function setDiscard(string $discard): void
    {
        $this->discard = $discard;
    }

    public function getIncomingSeq(): int
    {
        return $this->incomingSeq;
    }

    public function setIncomingSeq(int $incomingSeq): void
    {
        $this->incomingSeq = $incomingSeq;
    }

    public function getOutgoingSeq(): int
    {
        return $this->outgoingSeq;
    }

    public function setOutgoingSeq(int $outgoingSeq): void
    {
        $this->outgoingSeq = $outgoingSeq;
    }
}
