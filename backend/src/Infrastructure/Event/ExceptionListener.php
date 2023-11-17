<?php

namespace App\Infrastructure\Event;

use App\Infrastructure\Controller\JsonResponseTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ExceptionListener
{
    use JsonResponseTrait;

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $message = $exception->getMessage();

        if ($exception->getPrevious() instanceof ValidationFailedException) {
            $message = str_replace('This value should be of type unknown.\n', '',$message);
        }

        if ($_ENV['APP_ENV'] === 'dev') {
            $response = $this->json([
                'message'       => $message,
                'code'          => $exception->getCode(),
                'traces'        => $exception->getTrace()
            ]);
        } else {
            $response = $this->json([
                'message'       => $message,
                'code'          => $exception->getCode(),
            ]);
        }

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
            $response->headers->replace(['Content-Type' => 'application/json']);
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}
