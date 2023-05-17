<?php

namespace App\Modules\Contact\Events;

final readonly class ContactWasCreated
{
    public function __construct(
        public string $contactId,
        public string $firstName,
        public string $lastName
    ) {}
}
