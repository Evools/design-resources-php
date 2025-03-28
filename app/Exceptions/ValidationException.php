<?php

namespace App\Exceptions;

class ValidationException extends BaseException
{
  protected int $statusCode = 422;

  public function __construct(string $message = 'Ошибка валидации', array $errors = [])
  {
    parent::__construct($message, $errors);
  }

  public static function withErrors(array $errors): self
  {
    return new self('Ошибка валидации', $errors);
  }

  public static function withMessage(string $message): self
  {
    return new self($message);
  }
}
