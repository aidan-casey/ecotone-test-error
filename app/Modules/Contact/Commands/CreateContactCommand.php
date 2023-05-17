<?php

namespace App\Modules\Contact\Commands;

final readonly class CreateContactCommand
{
    public function __construct(
        public string $contactId,
        public string $firstName,
        public string $lastName
    ) {}
}
