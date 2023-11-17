<?php

namespace App\UI\Http\Rest\Controller\User;

use App\Application\User\Create\UserCreateDto;
use App\Application\User\Create\UserCreateUseCase;
use App\Infrastructure\Controller\JsonResponseTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/user/create", methods: [Request::METHOD_POST])]
class UserCreateController
{
    use JsonResponseTrait;

    public function __construct(
        private readonly UserCreateUseCase $useCase,
    ) {  
    }

    public function __invoke(#[MapRequestPayload] UserCreateDto $dto): JsonResponse
    {
        $response = $this->useCase->execute($dto);

        return $this->json($response);
    }
}
