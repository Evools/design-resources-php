<?php

namespace App\Http;

class Response
{
  private int $statusCode;
  private array $headers;
  private mixed $content;

  public function __construct(mixed $content = '', int $statusCode = 200, array $headers = [])
  {
    $this->content = $content;
    $this->statusCode = $statusCode;
    $this->headers = array_merge($this->getDefaultHeaders(), $headers);
  }

  public function send(): void
  {
    $this->sendHeaders();
    $this->sendContent();
  }

  private function sendHeaders(): void
  {
    if (headers_sent()) {
      return;
    }

    http_response_code($this->statusCode);

    foreach ($this->headers as $name => $value) {
      header(sprintf('%s: %s', $name, $value), true, $this->statusCode);
    }
  }

  private function sendContent(): void
  {
    echo $this->formatContent($this->content);
  }

  private function formatContent(mixed $content): string
  {
    if (is_array($content)) {
      return json_encode($content, JSON_UNESCAPED_UNICODE);
    }

    return (string) $content;
  }

  private function getDefaultHeaders(): array
  {
    return [
      'Content-Type' => 'application/json; charset=UTF-8',
      'X-Content-Type-Options' => 'nosniff',
      'X-Frame-Options' => 'DENY',
      'X-XSS-Protection' => '1; mode=block'
    ];
  }

  public static function json(array $data, int $statusCode = 200, array $headers = []): self
  {
    return new self($data, $statusCode, $headers);
  }

  public static function error(string $message, int $statusCode = 400, array $errors = []): self
  {
    $data = [
      'message' => $message,
      'errors' => $errors,
      'status' => $statusCode
    ];

    return new self($data, $statusCode);
  }
}
