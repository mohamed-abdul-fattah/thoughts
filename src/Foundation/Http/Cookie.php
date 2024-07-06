<?php

namespace App\Foundation\Http;

class Cookie
{
    private string $name;
    private string $value;
    private int $expiresIn;
    private string $path;
    private string $domain;
    private bool $secure;
    private bool $httpOnly;

    public function __construct(string $name, string $value, int $expiresIn, string $path = null, string $domain = null, bool $secure = false, bool $httpOnly = false)
    {
        $this->name      = $name;
        $this->value     = $value;
        $this->expiresIn = $expiresIn;
        $this->path      = $path   ?? '/';
        $this->domain    = $domain ?? '';
        $this->secure    = $secure;
        $this->httpOnly  = $httpOnly;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function isHttpOnly(): bool
    {
        return $this->httpOnly;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function isSecure(): bool
    {
        return $this->secure;
    }
}
