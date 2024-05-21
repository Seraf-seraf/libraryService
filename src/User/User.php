<?php

namespace User;

use Interface\Identifiable;

class User implements Identifiable
{
    private string $firstName;
    private string $lastName;
    private string $userId;

    public function __construct(string $firstName, string $lastName)
    {
        $this->userId = uniqid();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getId(): string
    {
        return $this->userId;
    }

    public function getFullName(): string
    {
        return $this->lastName . $this->firstName;
    }

    public function __toString(): string
    {
        return "Пользователь: " . $this->firstName . ' ' . $this->lastName;
    }

}