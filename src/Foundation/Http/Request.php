<?php

namespace App\Foundation\Http;

class Request
{
    private string $uri;
    private array $query = [];

    public function __construct()
    {
        $this->processUri();
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }

    private function processUri(): void
    {
        $parts     = parse_url($_SERVER['REQUEST_URI']);
        $this->uri = $parts['path'];

        parse_str($parts['query'] ?? '', $this->query);
    }
}
