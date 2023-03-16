<?php

namespace Core\Entities;

use Core\Entities\ValueObject\Email;
use DateTimeImmutable;

class User
{
    private array $channels = [];

    public function __construct(
        private int $id,
        private string $name,
        private Email $email,
        private string $phoneNumber
    ) {}

    public function setChannels(array $value): void
    {
        $this->channels = $value;
    }

    public function getChannels(): array
    {
        return $this->channels;
    }

    public function getEmail(): string
    {
        return $this->email->value;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phoneNumber' => $this->phoneNumber,
            'email' => $this->email->value,
            'channels' => $this->channels
        ];
    }
}
