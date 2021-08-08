<?php

namespace App\UserlandTransport;

use Symfony\Component\Notifier\Transport\AbstractTransportFactory;
use Symfony\Component\Notifier\Transport\Dsn;
use Symfony\Component\Notifier\Transport\TransportInterface;

class UserlandTransportFactory extends AbstractTransportFactory
{
    protected function getSupportedSchemes(): array
    {
       return ['userland'];
    }

    /**
     * In our example, we don't have to pass credentials
     * check https://github.com/symfony/linked-in-notifier/blob/5.3/LinkedInTransportFactory.php#L24
     * if you need to parse the DSN.
     */
    public function create(Dsn $dsn): TransportInterface
    {
        return new UserlandTransport();
    }
}