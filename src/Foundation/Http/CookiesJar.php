<?php

namespace App\Foundation\Http;

class CookiesJar
{
    private array $cookies;

    public function __construct()
    {
        $this->cookies = $_COOKIE;
    }

    public function get(string $key, $default = null): string
    {
        return $this->cookies[$key] ?? $default;
    }

    public function set(Cookie $cookie): void
    {
        setCookie(
            $cookie->getName(),
            $cookie->getValue(),
            $cookie->getExpiresIn(),
            $cookie->getPath(),
            $cookie->getDomain(),
            $cookie->isSecure(),
            $cookie->isHttpOnly()
        );

        $this->cookies[$cookie->getName()] = $cookie;
    }
}
