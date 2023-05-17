<?php

namespace App\Modules\Organization\Events;

final readonly class OrganizationWasCreated
{
    public function __construct(
        public string $organizationId,
        public string $name
    ) {}
}
