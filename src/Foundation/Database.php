<?php

namespace App\Foundation;

use App\Foundation\Exceptions\UnSupportedDatabaseDriverException;
use PDO;

class Database
{
  private static ?Database $database = null;

  private PDO $connection;

  public static function getInstance(): Database
  {
    if (self::$database) {
      return self::$database;
    }

    self::$database = new Database();
    return self::$database;
  }

  public function getObjects(string $query, string $className): array
  {
    return $this
      ->connection
      ->query($query, PDO::FETCH_CLASS, $className)
      ->fetchAll();
  }

  private function __construct()
  {
    extract($this->getConfigs());

    if ($driver === 'mysql') {
      $this->connection = new PDO("mysql:host={$host};dbname={$name}", $username, $password);
    } else {
      throw new UnSupportedDatabaseDriverException("'{$driver}' is not a supported database driver!");
    }
  }

  private function getConfigs(): array
  {
    return include app()->getConfigPath() . '/database.php';
  }
}
