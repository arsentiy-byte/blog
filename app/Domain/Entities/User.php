<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\ValueObjects\User\CreateVO;
use App\Domain\ValueObjects\User\UpdateVO;

final class User
{
    public function __construct(
        private readonly string $id,
        private string $name,
        private string $email,
        private string $password,
    ) {
    }

    public static function create(string $uuid, CreateVO $vo): self
    {
        return new self(
            $uuid,
            $vo->name,
            $vo->email,
            $vo->password,
        );
    }

    public function update(UpdateVO $vo): void
    {
        $this->name = $vo->name;
        $this->email = $vo->email;
        $this->password = $vo->password;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
