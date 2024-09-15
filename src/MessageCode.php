<?php

declare(strict_types=1);

namespace Octamp\Wamp\Message;

final class MessageCode
{
    public const MSG_UNKNOWN = 0;
    public const MSG_HELLO = HelloMessage::CODE;
    public const MSG_WELCOME = WelcomeMessage::CODE;
    public const MSG_ABORT = AbortMessage::CODE;
    public const MSG_CHALLENGE = ChallengeMessage::CODE;
    public const MSG_AUTHENTICATE = AuthenticateMessage::CODE;
    public const MSG_GOODBYE = GoodbyeMessage::CODE;
    public const MSG_HEARTBEAT = HeartbeatMessage::CODE;
    public const MSG_ERROR = ErrorMessage::CODE;
    public const MSG_PUBLISH = PublishMessage::CODE;
    public const MSG_PUBLISHED = PublishedMessage::CODE;
    public const MSG_SUBSCRIBE = SubscribeMessage::CODE;
    public const MSG_SUBSCRIBED = SubscribedMessage::CODE;
    public const MSG_UNSUBSCRIBE = UnsubscribeMessage::CODE;
    public const MSG_UNSUBSCRIBED = UnsubscribedMessage::CODE;
    public const MSG_EVENT = EventMessage::CODE;
    public const MSG_CALL = CallMessage::CODE;
    public const MSG_CANCEL = CancelMessage::CODE;
    public const MSG_RESULT = ResultMessage::CODE;
    public const MSG_REGISTER = RegisterMessage::CODE;
    public const MSG_REGISTERED = RegisteredMessage::CODE;
    public const MSG_UNREGISTER = UnregisterMessage::CODE;
    public const MSG_UNREGISTERED = UnregisteredMessage::CODE;
    public const MSG_INVOCATION = InvocationMessage::CODE;
    public const MSG_INTERRUPT = InterruptMessage::CODE;
    public const MSG_YIELD = YieldMessage::CODE;
}