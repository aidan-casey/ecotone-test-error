<?php

namespace App\Modules\Organization\Commands;

final readonly class CreateOrganizationCommand
{
    public function __construct(
        public string $organizationId,
        public string $name
    ) {}
}
