<?php

namespace App\Exceptions;

class BaseException extends \Exception
{
  protected array $errors = [];
  protected int $statusCode = 500;

  public function __construct(string $message = "", array $errors = [], int $code = 0)
  {
    parent::__construct($message, $code);
    $this->errors = $errors;
  }

  public function getErrors(): array
  {
    return $this->errors;
  }

  public function getStatusCode(): int
  {
    return $this->statusCode;
  }

  public function toArray(): array
  {
    return [
      'message' => $this->getMessage(),
      'errors' => $this->getErrors(),
      'code' => $this->getCode(),
      'status' => $this->getStatusCode()
    ];
  }
}
