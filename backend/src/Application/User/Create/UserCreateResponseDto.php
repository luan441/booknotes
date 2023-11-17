<?php

namespace App\Application\User\Create;

use App\Domain\User\User;
use JsonSerializable;

class UserCreateResponseDto implements JsonSerializable
{
    public string $message = 'Usuário criado com sucesso!';

    public function __construct(
        public User $user,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'message' => $this->message,
            'user' => $this->user,
        ];
    }
}
