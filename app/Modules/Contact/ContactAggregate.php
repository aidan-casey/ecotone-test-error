<?php

namespace App\Modules\Contact;

use App\Modules\Contact\Commands\CreateContactCommand;
use App\Modules\Contact\Events\ContactWasCreated;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\WithAggregateEvents;
use Ecotone\Modelling\WithAggregateVersioning;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[EventSourcingAggregate(true)]
final class ContactAggregate
{
    use WithAggregateEvents;
    use WithAggregateVersioning;

    #[AggregateIdentifier]
    private UuidInterface $contactId;

    #[CommandHandler]
    public static function create(CreateContactCommand $command): self
    {
        $contact = new self;

        $contact->recordThat(new ContactWasCreated(
            contactId: $command->contactId,
            firstName: $command->firstName,
            lastName: $command->lastName
        ));

        return $contact;
    }

    #[EventSourcingHandler]
    public function applyContactWasCreated(ContactWasCreated $event): void
    {
        $this->contactId = Uuid::fromString($event->contactId);
    }
}
