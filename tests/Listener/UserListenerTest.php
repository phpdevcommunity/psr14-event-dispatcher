<?php

namespace Test\PhpDevCommunity\Listener\Listener;

use Test\PhpDevCommunity\Listener\Event\PreCreateEventTest;

class UserListenerTest
{

    /**
     * Handle the event.
     *
     * @param PreCreateEventTest $event
     */
    public function __invoke(PreCreateEventTest $event): void
    {
        $object = $event->getObject();
        if ($object instanceof \stdClass) {
            $object->foo = 'bar';
        }
    }

}
