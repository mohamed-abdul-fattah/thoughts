<?php

namespace App\Repositories;

use App\Foundation\Database;
use App\Repositories\Exceptions\RecordNotFoundException;
use App\Utils\StringUtils;
use ReflectionException;

abstract class Repository
{
    protected string $primary = 'id';

    private Database $connection;
    private string   $entityName;
    private string   $tableName;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        $this->connection = Database::getInstance();
        $this->entityName = $this->getEntityName();
        $this->tableName  = $this->getTableName();
    }

    abstract protected function getEntityName(): string;

    public function fetchAll(): array
    {
        return $this->connection->getObjects(
            "SELECT * FROM `$this->tableName`",
            $this->entityName
        );
    }

    public function find(int $id)
    {
        $result = $this->connection->getObjects(
            "SELECT * FROM `$this->tableName` WHERE `$this->primary`=$id LIMIT 1",
            $this->entityName
        );

        if (count($result) === 0) {
            throw new RecordNotFoundException("$this->entityName with ID $id is not found!");
        }

        return $result[0];
    }

    /**
     * @throws ReflectionException
     */
    private function getTableName(): string
    {
        $classPluralName = StringUtils::replace(StringUtils::getClassShortName($this), 'Repository', '');

        return StringUtils::toLower($classPluralName);
    }
}
