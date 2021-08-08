<?php

namespace App\UserlandTransport;

use Symfony\Component\Notifier\Message\MessageInterface;
use Symfony\Component\Notifier\Message\SentMessage;
use Symfony\Component\Notifier\Transport\AbstractTransport;

final class UserlandTransport extends AbstractTransport
{
    private const TRANSPORT = 'userland';

    protected function doSend(MessageInterface $message): SentMessage
    {
        // Retrieve the content of the Notification, "Welcome abroad <3" in our example
        $message->getSubject();

        //dd($message);
        // Your custom stuff to call the API,
        // I assume everything is good but you should check the code status and handle errors.
        $result = $this->client->request('POST', 'https://www.api.userland.io', [
            'body' => ['message' => $message->getSubject()]
        ]);

        // Create an instance of SentMessage that should be returned to respect the contract.
        $sentMessage = new SentMessage($message, (string) $this);

        // Suppose the API returns the id of the transaction.
        $sentMessage->setMessageId($result['id']);

        // 💡 for your information this object will be passed to an event.
        return $sentMessage;
    }

    public function supports(MessageInterface $message): bool
    {
        return self::TRANSPORT === $message->getTransport();
    }

    public function __toString(): string
    {
        return self::TRANSPORT;
    }
}