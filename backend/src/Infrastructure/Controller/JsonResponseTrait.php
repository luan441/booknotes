<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

trait JsonResponseTrait
{
    private function json(
        mixed $data,
        int $status = 200,
        array $headers = [],
        bool $json = false
    ): JsonResponse
    {
        return new JsonResponse($data, $status, $headers, $json);
    }
}
