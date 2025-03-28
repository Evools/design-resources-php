<?php

namespace App\Http;

class Request
{
  private array $get;
  private array $post;
  private array $server;
  private array $files;
  private array $headers;

  public function __construct()
  {
    $this->get = $_GET;
    $this->post = $_POST;
    $this->server = $_SERVER;
    $this->files = $_FILES;
    $this->headers = $this->getHeaders();
  }

  public function getMethod(): string
  {
    return $this->server['REQUEST_METHOD'];
  }

  public function isGet(): bool
  {
    return $this->getMethod() === 'GET';
  }

  public function isPost(): bool
  {
    return $this->getMethod() === 'POST';
  }

  public function get(string $key = null, mixed $default = null): mixed
  {
    if ($key === null) {
      return $this->get;
    }

    return $this->get[$key] ?? $default;
  }

  public function post(string $key = null, mixed $default = null): mixed
  {
    if ($key === null) {
      return $this->post;
    }

    return $this->post[$key] ?? $default;
  }

  public function getJson(): array
  {
    $content = file_get_contents('php://input');
    return json_decode($content, true) ?: [];
  }

  public function getFiles(): array
  {
    return $this->files;
  }

  public function getHeaders(): array
  {
    if (!empty($this->headers)) {
      return $this->headers;
    }

    $headers = [];
    foreach ($this->server as $key => $value) {
      if (str_starts_with($key, 'HTTP_')) {
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
      }
    }

    return $headers;
  }

  public function getHeader(string $key): ?string
  {
    return $this->headers[$key] ?? null;
  }

  public function getIp(): string
  {
    if (!empty($this->server['HTTP_CLIENT_IP'])) {
      return $this->server['HTTP_CLIENT_IP'];
    }

    if (!empty($this->server['HTTP_X_FORWARDED_FOR'])) {
      return $this->server['HTTP_X_FORWARDED_FOR'];
    }

    return $this->server['REMOTE_ADDR'] ?? '';
  }

  public function getUserAgent(): string
  {
    return $this->server['HTTP_USER_AGENT'] ?? '';
  }

  public function getUri(): string
  {
    return $this->server['REQUEST_URI'] ?? '/';
  }

  public function isAjax(): bool
  {
    return $this->getHeader('X-Requested-With') === 'XMLHttpRequest';
  }

  public function isSecure(): bool
  {
    return (!empty($this->server['HTTPS']) && $this->server['HTTPS'] !== 'off')
      || $this->server['SERVER_PORT'] == 443;
  }
}
