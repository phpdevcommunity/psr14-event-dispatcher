# PSR-14 Event Dispatcher

This library provides an easy-to-use implementation of a PSR-14 event dispatcher, allowing you to manage event-driven functionality in your PHP applications.

## Installation

Make sure to include the library in your `composer.json` or install it directly:

```bash
composer require phpdevcommunity/psr14-event-dispatcher
```

## Creating an Event

To create a custom event, extend the `Event` class provided by the library:

```php
<?php

namespace App\Event;

use PhpDevCommunity\Listener\Event;

/**
 * Class PreCreateEvent
 * @package App\Event
 */
class PreCreateEvent extends Event
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
```

## Creating a Listener

A listener class handles the event logic. It should implement an `__invoke` method that accepts the event as a parameter:

```php
<?php

namespace App\Listener;

use App\Entity\User;
use App\Event\PreCreateEvent;

/**
 * Class UserListener
 * @package App\Listener
 */
class UserListener
{
    /**
     * Handle the event.
     * 
     * @param PreCreateEvent $event
     */
    public function __invoke(PreCreateEvent $event): void
    {
        $object = $event->getObject();

        if ($object instanceof User) {
            // Perform actions with the User object
        }
    }
}
```

## Usage

To use the event dispatcher, register your listeners with a `ListenerProvider` and dispatch events as needed:

```php
<?php

use App\Event\PreCreateEvent;
use App\Listener\UserListener;

// Create the listener provider and register the listener
$listenerProvider = (new ListenerProvider())
    ->addListener(PreCreateEvent::class, new UserListener());

// Create the event dispatcher with the listener provider
$dispatcher = new \PhpDevCommunity\Listener\EventDispatcher($listenerProvider);

// Dispatch the event after saving a user to the database
$dispatcher->dispatch(new PreCreateEvent($user));
```

**Note**: When the `PreCreateEvent` is dispatched, `UserListener` will be automatically invoked if the event matches its type.

## Example Use Case

Suppose you have a `User` entity that requires additional logic to be executed after being persisted to the database, such as sending a welcome email or logging activity. You can use the `PreCreateEvent` and `UserListener` to encapsulate this behavior, keeping your code clean and following the event-driven design pattern.

## License

This library is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

