<?php

namespace Core\Entities;

use DateTimeImmutable;

class Notification
{
    public function __construct(
        private readonly int $id,
        private readonly int $category,
        private readonly string $message
    ) {}

    public function getCategory(): int
    {
        return $this->category;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function toArray()
    {
        return [
            $this->category,
            $this->message
        ];
    }

    public function getId()
    {
        return $this->id;
    }
}
