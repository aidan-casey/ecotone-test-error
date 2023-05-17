<?php

namespace App\Modules\Organization;

use App\Modules\Organization\Commands\CreateOrganizationCommand;
use App\Modules\Organization\Events\OrganizationWasCreated;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\WithAggregateEvents;
use Ecotone\Modelling\WithAggregateVersioning;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[EventSourcingAggregate(true)]
final class OrganizationAggregate
{
    use WithAggregateEvents;
    use WithAggregateVersioning;

    #[AggregateIdentifier]
    private UuidInterface $organizationId;

    #[CommandHandler]
    public static function create(CreateOrganizationCommand $command): self
    {
        $organization = new self;

        $organization->recordThat(new OrganizationWasCreated(
            organizationId: $command->organizationId,
            name: $command->name
        ));

        return $organization;
    }

    #[EventSourcingHandler]
    public function applyOrganizationWasCreated(OrganizationWasCreated $event): void
    {
        $this->organizationId = Uuid::fromString($event->organizationId);
    }
}
