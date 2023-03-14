<?php

namespace Core\Entities;

use Core\Entities\ValueObject\Email;
use DateTimeImmutable;

class User
{
    private string $id;
    private DateTimeImmutable $createAt;
    private array $subscribed;
    private array $channels;

    public function __construct(
        private string $name,
        private Email $email,
        private string $phoneNumber
    ) {
        $this->id = uniqid(time() . $name . $phoneNumber);
        $this->createAt = new DateTimeImmutable();
    }
}
