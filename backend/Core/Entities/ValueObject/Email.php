<?php

namespace Core\Entities\ValueObject;

class Email
{
    public function __construct(
        public string $value
    ) {
      $this->validate();
    }

    private function validate(): void
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('E-mail not valid!');
        }
    }
}
