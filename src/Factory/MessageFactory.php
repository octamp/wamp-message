<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message\Factory;

use Octamp\Wamp\Message\AbortMessage;
use Octamp\Wamp\Message\AuthenticateMessage;
use Octamp\Wamp\Message\CallMessage;
use Octamp\Wamp\Message\CancelMessage;
use Octamp\Wamp\Message\ChallengeMessage;
use Octamp\Wamp\Message\ErrorMessage;
use Octamp\Wamp\Message\EventMessage;
use Octamp\Wamp\Message\GoodbyeMessage;
use Octamp\Wamp\Message\HeartbeatMessage;
use Octamp\Wamp\Message\HelloMessage;
use Octamp\Wamp\Message\InterruptMessage;
use Octamp\Wamp\Message\InvocationMessage;
use Octamp\Wamp\Message\Message;
use Octamp\Wamp\Message\MessageCode;
use Octamp\Wamp\Message\MessageException;
use Octamp\Wamp\Message\PublishedMessage;
use Octamp\Wamp\Message\PublishMessage;
use Octamp\Wamp\Message\RegisteredMessage;
use Octamp\Wamp\Message\RegisterMessage;
use Octamp\Wamp\Message\ResultMessage;
use Octamp\Wamp\Message\SubscribedMessage;
use Octamp\Wamp\Message\SubscribeMessage;
use Octamp\Wamp\Message\UnregisteredMessage;
use Octamp\Wamp\Message\UnregisterMessage;
use Octamp\Wamp\Message\UnsubscribedMessage;
use Octamp\Wamp\Message\UnsubscribeMessage;
use Octamp\Wamp\Message\WelcomeMessage;
use Octamp\Wamp\Message\YieldMessage;

class MessageFactory implements MessageFactoryInterface
{
    /**
     * @throws MessageException
     */
    public static function createMessage(array $data): Message
    {
        if ($data !== array_values($data)) {
            throw new MessageException('Invalid WAMP message format');
        }

        return match ($data[0]) {
            MessageCode::MSG_ABORT => new AbortMessage($data[1], $data[2]), // [ABORT, Details|dict, Reason|uri]
            MessageCode::MSG_HELLO => new HelloMessage($data[1], $data[2]), // [HELLO, Realm|uri, Details|dict]
            MessageCode::MSG_SUBSCRIBE => new SubscribeMessage($data[1], $data[2], $data[3]), // [SUBSCRIBE, Request|id, Options|dict, Topic|uri]
            MessageCode::MSG_UNSUBSCRIBE => new UnsubscribeMessage($data[1], $data[2]), // [UNSUBSCRIBE, Request|id, SUBSCRIBED.Subscription|id]
            // [PUBLISH, Request|id, Options|dict, Topic|uri]
            // [PUBLISH, Request|id, Options|dict, Topic|uri, Arguments|list]
            // [PUBLISH, Request|id, Options|dict, Topic|uri, Arguments|list, ArgumentsKw|dict]
            MessageCode::MSG_PUBLISH => new PublishMessage($data[1], $data[2], $data[3], static::getArgs($data, 4), static::getArgs($data, 5)),
            MessageCode::MSG_GOODBYE => new GoodbyeMessage($data[1], $data[2]), // [GOODBYE, Details|dict, Reason|uri]
            MessageCode::MSG_AUTHENTICATE => new AuthenticateMessage($data[1], $data[2]), // [AUTHENTICATE, Signature|string, Extra|dict]
            MessageCode::MSG_REGISTER => new RegisterMessage($data[1], $data[2], $data[3]), // [REGISTER, Request|id, Options|dict, Procedure|uri]
            MessageCode::MSG_UNREGISTER => new UnregisterMessage($data[1], $data[2]), // [UNREGISTER, Request|id, REGISTERED.Registration|id]
            MessageCode::MSG_UNREGISTERED => new UnregisteredMessage($data[1]), // [UNREGISTERED, UNREGISTER.Request|id]
            // [CALL, Request|id, Options|dict, Procedure|uri]
            // [CALL, Request|id, Options|dict, Procedure|uri, Arguments|list]
            // [CALL, Request|id, Options|dict, Procedure|uri, Arguments|list, ArgumentsKw|dict]
            MessageCode::MSG_CALL => new CallMessage($data[1], $data[2], $data[3], static::getArgs($data, 4), static::getArgs($data, 5)),
            // [YIELD, INVOCATION.Request|id, Options|dict]
            // [YIELD, INVOCATION.Request|id, Options|dict, Arguments|list]
            // [YIELD, INVOCATION.Request|id, Options|dict, Arguments|list, ArgumentsKw|dict]
            MessageCode::MSG_YIELD => new YieldMessage($data[1], $data[2], static::getArgs($data, 3), static::getArgs($data, 4)),
            MessageCode::MSG_WELCOME => new WelcomeMessage($data[1], $data[2]), // [WELCOME, Session|id, Details|dict]
            MessageCode::MSG_SUBSCRIBED => new SubscribedMessage($data[1], $data[2]), // [SUBSCRIBED, SUBSCRIBE.Request|id, Subscription|id]
            MessageCode::MSG_UNSUBSCRIBED => new UnsubscribedMessage($data[1]), // [UNSUBSCRIBED, UNSUBSCRIBE.Request|id]
            // [EVENT, SUBSCRIBED.Subscription|id, PUBLISHED.Publication|id, Details|dict]
            // [EVENT, SUBSCRIBED.Subscription|id, PUBLISHED.Publication|id, Details|dict, PUBLISH.Arguments|list]
            // [EVENT, SUBSCRIBED.Subscription|id, PUBLISHED.Publication|id, Details|dict, PUBLISH.Arguments|list, PUBLISH.ArgumentsKw|dict]
            MessageCode::MSG_EVENT => new EventMessage($data[1], $data[2], $data[3], static::getArgs($data, 4), static::getArgs($data, 5)),
            MessageCode::MSG_REGISTERED => new RegisteredMessage($data[1], $data[2]), // [REGISTERED, REGISTER.Request|id, Registration|id]
            // [INVOCATION, Request|id, REGISTERED.Registration|id, Details|dict]
            // [INVOCATION, Request|id, REGISTERED.Registration|id, Details|dict, CALL.Arguments|list]
            // [INVOCATION, Request|id, REGISTERED.Registration|id, Details|dict, CALL.Arguments|list, CALL.ArgumentsKw|dict]
            MessageCode::MSG_INVOCATION => new InvocationMessage($data[1], $data[2], $data[3], static::getArgs($data, 4), static::getArgs($data, 5)),
            // [RESULT, CALL.Request|id, Details|dict]
            // [RESULT, CALL.Request|id, Details|dict, YIELD.Arguments|list]
            // [RESULT, CALL.Request|id, Details|dict, YIELD.Arguments|list, YIELD.ArgumentsKw|dict]
            MessageCode::MSG_RESULT => new ResultMessage($data[1], $data[2], static::getArgs($data, 3), static::getArgs($data, 4)),
            MessageCode::MSG_PUBLISHED => new PublishedMessage($data[1], $data[2]), // [PUBLISHED, PUBLISH.Request|id, Publication|id]
            MessageCode::MSG_CHALLENGE => new ChallengeMessage($data[1], $data[2]), // [CHALLENGE, AuthMethod|string, Extra|dict]
            // [HEARTBEAT, IncomingSeq|integer, OutgoingSeq|integer
            // [HEARTBEAT, IncomingSeq|integer, OutgoingSeq|integer, Discard|string]
            MessageCode::MSG_HEARTBEAT => static::createHeartBeatMessage($data),
            MessageCode::MSG_CANCEL => new CancelMessage($data[1], $data[2]), // [CANCEL, CALL.Request|id, Options|dict]
            MessageCode::MSG_INTERRUPT => new InterruptMessage($data[1], $data[2]), // [INTERRUPT, INVOCATION.Request|id, Options|dict]
            // [ERROR, REQUEST.Type|int, REQUEST.Request|id, Details|dict, Error|uri]
            // [ERROR, REQUEST.Type|int, REQUEST.Request|id, Details|dict, Error|uri, Arguments|list]
            // [ERROR, REQUEST.Type|int, REQUEST.Request|id, Details|dict, Error|uri, Arguments|list, ArgumentsKw|dict]
            MessageCode::MSG_ERROR => new ErrorMessage($data[1], $data[2], $data[3], $data[4], static::getArgs($data, 5), static::getArgs($data, 6)),
            default => throw new MessageException('Unhandled message type: ' . $data[0])
        };
    }

    private static function createHeartBeatMessage(array $data): HeartbeatMessage
    {
        $discard = null;
        if (isset($data[3])) {
            $discard = $data[3];
        }

        return new HeartbeatMessage($data[1], $data[2], $discard);
    }

    private static function getArgs(array $data, int $position): mixed
    {
        return $data[$position] ?? null;
    }
}