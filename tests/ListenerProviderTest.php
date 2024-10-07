<?php

namespace Test\PhpDevCommunity\Listener;

use PhpDevCommunity\Listener\EventDispatcher;
use PhpDevCommunity\Listener\ListenerProvider;
use PhpDevCommunity\UniTester\TestCase;
use Test\PhpDevCommunity\Listener\Event\PreCreateEventTest;
use Test\PhpDevCommunity\Listener\Listener\UserListenerTest;

class ListenerProviderTest extends TestCase
{

    protected function setUp(): void
    {
        // TODO: Implement setUp() method.
    }

    protected function tearDown(): void
    {
        // TODO: Implement tearDown() method.
    }

    protected function execute(): void
    {
        $listenerProvider = new ListenerProvider();
        $listenerProvider->addListener(PreCreateEventTest::class, new UserListenerTest());
        $dispatcher = new EventDispatcher($listenerProvider);
        $user = new \stdClass();
        $user->foo = null;
        $dispatcher->dispatch(new PreCreateEventTest($user));

        $this->assertStrictEquals("bar", $user->foo);
    }
}
