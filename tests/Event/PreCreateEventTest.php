<?php

namespace Test\PhpDevCommunity\Listener\Event;

use PhpDevCommunity\Listener\Event;

final class PreCreateEventTest extends Event
{

    private object $object;

    /**
     * PreCreateEvent constructor.
     *
     * @param object $object
     */
    public function __construct(object $object)
    {
        $this->object = $object;
    }

    /**
     * Get the associated object.
     *
     * @return object
     */
    public function getObject(): object
    {
        return $this->object;
    }
}
