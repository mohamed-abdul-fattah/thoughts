<?php

namespace App\Repositories;

use App\Foundation\Database;
use App\Utils\StringUtils;
use ReflectionClass;

abstract class Repository
{
  private Database $connection;
  private string $entityName;
  private string $tableName;

  public function __construct()
  {
    $this->connection = Database::getInstance();
    $this->entityName = $this->getEntityName();
    $this->tableName  = $this->getTableName();
  }

  public function fetchAll(): array
  {
    return $this->connection->getObjects(
      "SELECT * FROM {$this->tableName}",
      $this->entityName
    );
  }

  private function getTableName(): string
  {
    $classPluralName = StringUtils::replace($this->getClassName(), 'Repository', '');

    return StringUtils::toLower($classPluralName);
  }

  private function getClassName(): string
  {
    return (new ReflectionClass(get_called_class()))->getShortName();
  }

  abstract protected function getEntityName(): string;
}
