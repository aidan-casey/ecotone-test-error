<?php

namespace App\Modules\Contact\Reactors;

use App\Modules\Contact\Events\ContactWasCreated;
use Ecotone\Modelling\Attribute\EventHandler;
use Illuminate\Notifications\Channels\MailChannel;

/**
 * This (incomplete) class simply shows that Ecotone
 * attempts to pull it from the container.
 */
final readonly class SendWelcomeEmailReactor
{
    public function __construct(private MailChannel $sender)
    {}

    #[EventHandler]
    public function onContactWasCreated(ContactWasCreated $event)
    {
        // Send the email message.
    }
}
