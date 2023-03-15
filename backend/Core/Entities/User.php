<?php

namespace Core\Entities;

use Core\Entities\ValueObject\Email;
use DateTimeImmutable;

class User
{
    private readonly string $id;
    private DateTimeImmutable $createAt;
    private array $subscribed = [];
    private array $channels = [];

    public function __construct(
        private string $name,
        private Email $email,
        private string $phoneNumber
    ) {
        $this->id = sha1(time() . $name . $phoneNumber);
        $this->createAt = new DateTimeImmutable();
    }

    public function setChannels(array $value): void
    {
        $this->channels = $value;
    }

    public function getChannels(): array
    {
        return $this->channels;
    }

    public function toArray(): array
    {
        return [
            $this->id,
            $this->name,
            $this->phoneNumber,
            $this->email->value,
            $this->createAt->format("d/m/y H:i"),
            $this->subscribed,
            $this->channels
        ];
    }
}
