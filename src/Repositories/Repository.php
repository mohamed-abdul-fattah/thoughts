<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Foundation\Database;
use App\Repositories\Exceptions\RecordNotFoundException;
use App\Utils\StringUtils;
use DateTime;
use ReflectionClass;
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

    public function findBy(array $conditions): array
    {
        $whereConditions = [];
        foreach ($conditions as $column => $value) {
            $whereConditions[] = "`$column` = $value";
        }

        $whereClause = join(' AND ', $whereConditions);
        return $this->connection->getObjects(
            "SELECT * FROM `$this->tableName` WHERE $whereClause",
            $this->entityName
        );
    }

    public function save(Entity $entity): bool
    {
        $properties = $this->getEntityColumns($entity);
        $properties = $this->excludePrimaryKey($properties);
        $properties['updatedAt'] = (new DateTime())->format('Y-m-d H:i:s');

        if ($entity->isPersisted()) {
            return $this->connection->update($this->tableName, $properties, [$this->primary => $entity->getId()]
            );
        } else {
            return $this->connection->insert($this->tableName, $properties);
        }
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `$this->tableName` WHERE `$this->primary`=?";
        return $this->connection->execute($sql, [$id]);
    }

    /**
     * @throws ReflectionException
     */
    private function getTableName(): string
    {
        $classPluralName = StringUtils::replace(StringUtils::getClassShortName($this), 'Repository', '');

        return StringUtils::toLower($classPluralName);
    }

    private function getEntityColumns(Entity $entity): array
    {
        $cols    = [];
        $reflect = new ReflectionClass($entity);

        foreach ($reflect->getProperties() as $property) {
            if ($property->isInitialized($entity)) {
                $cols[$property->getName()] = $property->getValue($entity);
            }
        }

        return $cols;
    }

    private function excludePrimaryKey(array $columns): array
    {
        unset($columns['id']);
        return $columns;
    }
}
