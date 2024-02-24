<?php

namespace App\Repositories;

use App\Foundation\Database;
use App\Utils\StringUtils;
use ReflectionException;

abstract class Repository
{
  private Database $connection;
  private string $entityName;
  private string $tableName;

  /**
   * @throws ReflectionException
   */
  public function __construct()
  {
    $this->connection = Database::getInstance();
    $this->entityName = $this->getEntityName();
    $this->tableName  = $this->getTableName();
  }

  public function fetchAll(): array
  {
    return $this->connection->getObjects(
      "SELECT * FROM `$this->tableName`",
      $this->entityName
    );
  }

  /**
   * @throws ReflectionException
   */
  private function getTableName(): string
  {
    $classPluralName = StringUtils::replace(StringUtils::getClassShortName($this), 'Repository', '');

    return StringUtils::toLower($classPluralName);
  }

  abstract protected function getEntityName(): string;
}
