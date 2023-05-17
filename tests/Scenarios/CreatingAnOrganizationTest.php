<?php

namespace Tests\Scenarios;

use App\Modules\Organization\Commands\CreateOrganizationCommand;
use App\Modules\Organization\Events\OrganizationWasCreated;
use App\Modules\Organization\OrganizationAggregate;
use Ecotone\Lite\EcotoneLite;
use PHPUnit\Framework\TestCase;

class CreatingAnOrganizationTest extends TestCase
{
    public function test_organization_was_created_event_is_recorded()
    {
        $scenario = EcotoneLite::bootstrapFlowTesting([
            OrganizationAggregate::class
        ]);

        $command = $this->createCommand();

        $scenario->sendCommand($command);

        $this->assertEquals(
            [
                new OrganizationWasCreated(
                    organizationId: $command->organizationId,
                    name: $command->name
                )
            ],
            $scenario->getRecordedEvents()
        );
    }

    private function createCommand(): CreateOrganizationCommand
    {
        return new CreateOrganizationCommand(
            organizationId: fake()->uuid,
            name: fake()->company,
        );
    }
}
