<?php

namespace App\EventListener\InternalApi;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class KernelExceptionListener
{
  public function onKernelException(ExceptionEvent $event)
  {
    $exception = $event->getThrowable();
    $defaultMessage = 'Internal Server Error';

    if ($exception instanceof HttpExceptionInterface) {
      $status = $exception->getStatusCode();
      $headers = $exception->getHeaders();
      $message = Response::$statusTexts[$status] ?? $defaultMessage;
    } else {
      $status = Response::HTTP_INTERNAL_SERVER_ERROR;
      $headers = [];
      $message = $defaultMessage;
    }

    $data = [
      'errors' => [
        'message' => $message,
        'status' => $status,
      ]
    ];

    $event->setResponse(new JsonResponse($data, $status, $headers));
  }
}