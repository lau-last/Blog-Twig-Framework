<?php

namespace App\Entity;

use Core\Entity\Hydrate;

abstract class UserEntity extends Hydrate
{

    protected int $id;

    protected string $name;

    protected string $password;

    protected string $email;

    protected string $role;

    protected string $date;

    protected string $token;

    protected string $expirationDate;

    protected string $validation;


    public function getExpirationDate(): string
    {
        return $this->expirationDate;

    }


    public function setExpirationDate(string $expirationDate): self
    {
        $this->expirationDate = $expirationDate;
        return $this;

    }


    public function getToken(): string
    {
        return $this->token;

    }


    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;

    }


    public function getDate(): string
    {
        return $this->date;

    }


    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;

    }


    public function getId(): int
    {
        return $this->id;

    }


    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;

    }


    public function getName(): string
    {
        return $this->name;

    }


    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;

    }


    public function getPassword(): string
    {
        return $this->password;

    }


    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;

    }


    public function getEmail(): string
    {
        return $this->email;

    }


    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;

    }


    public function getRole(): string
    {
        return $this->role;

    }


    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;

    }


    public function getValidation(): string
    {
        return $this->validation;

    }


    public function setValidation(string $validation): self
    {
        $this->validation = $validation;
        return $this;

    }


}
