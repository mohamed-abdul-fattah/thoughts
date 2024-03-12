<?php

namespace App\Foundation;

use ReflectionClass;
use ReflectionException;
use ReflectionParameter;
use RuntimeException;

class DependencyContainer
{
    private static array $instances = [];

    /**
     * Register a concretion to an abstraction
     */
    public static function inject(string $abstract, string $concrete = null): void
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }

        self::$instances[$abstract] = $concrete;
    }

    /**
     * Resolves an abstraction to its registered concretion
     *
     * @param  string $abstract
     * @return mixed
     * @throws RunTimeException|ReflectionException
     */
    public static function resolve(string $abstract): mixed
    {
        if (! isset(self::$instances[$abstract])) {
            self::inject($abstract);
        }

        return self::instantiate(self::$instances[$abstract]);
    }

    /**
     * @throws ReflectionException
     */
    private static function instantiate(string $concrete): mixed
    {
        try {
            $reflector = new ReflectionClass($concrete);
        } catch (ReflectionException) {
            throw new RunTimeException("Cannot reflect $concrete class!");
        }

        if (! $reflector->isInstantiable()) {
            throw new RunTimeException("Class $concrete is not instantiable!");
        }

        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return $reflector->newInstance();
        }

        $parameters   = $constructor->getParameters();
        $dependencies = self::getDependencies($parameters);

        // Get new instance with dependencies resolved
        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * @param ReflectionParameter[] $parameters
     * @return array
     * @throws ReflectionException
     */
    private static function getDependencies(array $parameters): array
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getType();
            if (is_null($dependency)) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new RuntimeException("Cannot resolve class dependency {$parameter->getName()}!");
                }
            } else {
                $dependencies[] = self::resolve($dependency->getName());
            }
        }

        return $dependencies;
    }
}
