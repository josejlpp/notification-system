<?php

namespace Core\Entities;

use DateTimeImmutable;

class Notification
{
    private string $id;
    private DateTimeImmutable $createAt;
    public function __construct(
        private int $category,
        private string $message
    ) {
        $this->id = uniqid(time() . $category);
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
}
