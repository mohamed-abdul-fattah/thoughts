<?php

namespace App\Foundation\Http;

class Response
{
  private const string TEXT_HTML_CONTENT        = 'text/html';
  private const string APPLICATION_JSON_CONTENT = 'application/json';

  private string $body;
  private string $contentType;

  public function setHtml(string $html): Response
  {
    $this->body        = $html;
    $this->contentType = self::TEXT_HTML_CONTENT;

    return $this;
  }

  public function setJson(string $json): Response
  {
    $this->body        = $json;
    $this->contentType = self::APPLICATION_JSON_CONTENT;

    return $this;
  }

  public function __toString(): string
  {
    header("Content-Type: {$this->contentType}");

    return $this->body;
  }
}
