<?php

namespace App\Application\User\Create;

use App\Domain\User\User;
use Symfony\Component\Validator\Constraints as Assert;

class UserCreateDto
{
    public function __construct(
        #[Assert\NotBlank(message: "Nome é um campo obrigatório")]
        #[Assert\Length(min: 3)]
        public readonly string $name,
        #[Assert\NotBlank(message: "Username é um campo obrigatório")]
        #[Assert\Length(min: 4, maxMessage: 16)]
        public readonly string $username,
        #[Assert\NotBlank(message: "Password é um campo obrigatório")]
        public readonly string $password,
        #[Assert\NotBlank(message: "Confirme password é um campo obrigatório")]
        public readonly string $confirmPassword,
    ) {
    }

    public function comparePassword(): bool
    {
        return $this->password === $this->confirmPassword;
    }

    public function toModel(): User
    {
        return new User($this->name, $this->username);
    }
}
