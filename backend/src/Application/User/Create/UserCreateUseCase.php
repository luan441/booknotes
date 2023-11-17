<?php

namespace App\Application\User\Create;

use App\Application\User\Create\Exception\UserCreateNotEqualPasswordException;
use App\Domain\User\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCreateUseCase
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private UserRepository $userRepository,
    ) {     
    }

    public function execute(UserCreateDto $dto): UserCreateResponseDto
    {
        if (!$dto->comparePassword()) {
            throw new UserCreateNotEqualPasswordException();
        }

        $user = $dto->toModel();

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $dto->password,
        );

        $user->setPassword($hashedPassword);

        $user = $this->userRepository->save($user);
        dump($user);
        exit;

        return new UserCreateResponseDto($user);
    }
}
