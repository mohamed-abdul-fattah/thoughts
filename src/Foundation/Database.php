<?php

namespace App\Foundation;

use App\Foundation\Exceptions\UnSupportedDatabaseDriverException;
use PDO;
use ReflectionException;

class Database
{
    private static ?Database $database = null;

    private PDO $connection;

    /**
     * @throws ReflectionException
     */
    private function __construct()
    {
        extract($this->getConfigs());

        if ($driver === 'mysql') {
            $this->connection = new PDO("mysql:host={$host};dbname={$name}", $username, $password);
        } else {
            throw new UnSupportedDatabaseDriverException("'{$driver}' is not a supported database driver!");
        }
    }

    /**
     * @throws ReflectionException
     */
    private function getConfigs(): array
    {
        /** @var Config $config */
        $config = DependencyContainer::resolve(Config::class);
        return $config->getDatabaseConfigs();
    }

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
        return $this->connection->query($query, PDO::FETCH_CLASS, $className)->fetchAll();
    }

    public function insert(string $tableName, array $values): bool
    {
        $columnNames   = implode(',', array_keys($values));
        $placeholders  = '?';
        $placeholders .= str_repeat(',?', count($values) - 1);
        $stmt          = $this->connection->prepare("INSERT INTO `$tableName` ($columnNames) VALUES ($placeholders)");

        return $stmt->execute(array_values($values));
    }

    public function execute(string $query, array $values): bool
    {
        $stmt = $this->connection->prepare($query);
        return $stmt->execute($values);
    }
}
