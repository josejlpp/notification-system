<?php

namespace Core\Entities;

use DateTimeImmutable;

class Notification
{
    private readonly string $id;
    private DateTimeImmutable $createAt;
    public function __construct(
        private readonly int $category,
        private readonly string $message
    ) {
        $this->id = sha1(time() . $category);
        $this->createAt = new DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

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
            $this->id,
            $this->category,
            $this->message,
            $this->createAt->format('d/m/y H:i')
        ];
    }
}
