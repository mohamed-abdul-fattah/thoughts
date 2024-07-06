<?php

namespace App\Foundation\Http;

class Request
{
    public const string HTTP_GET  = 'GET';
    public const string HTTP_POST = 'POST';

    private string $uri;
    private array  $query = [];
    private array  $post  = [];
    public CookiesJar $cookies;

    public function __construct()
    {
        $this->processUri();
        $this->getPayload();
        $this->cookies = new CookiesJar();
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function has(string $key): bool
    {
        return $this->query[$key] ?? $this->post[$key] ?? false;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }

    public function post(string $key, mixed $default = null): mixed
    {
        return $this->post[$key] ?? $default;
    }

    public function isPost(): bool
    {
        return self::HTTP_POST === $_SERVER['REQUEST_METHOD'];
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function processUri(): void
    {
        $parts     = parse_url($_SERVER['REQUEST_URI']);
        $this->uri = $parts['path'];

        parse_str($parts['query'] ?? '', $this->query);
    }

    private function getPayload(): void
    {
        $this->post = $_POST;
    }
}
