<?php
namespace Pharckager\Builder;

use King23\DI\ContainerInterface;

class BuilderFactory implements BuilderFactoryInterface
{
    /**
     * @var array
     */
    protected $map = [];

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
    }

    /**
     * @param $type
     * @return BuilderInterface
     * @throws \Exception
     */
    public function getBuilderFor($type)
    {
        if (!isset($this->map[$type])) {
            throw new \Exception("no builder type $type known");
        }

        // return an instance of the builder
        return $this->container->getInstanceOf($this->map[$type]);
    }

    /**
     * @return string[]
     */
    public function getTypes()
    {
        return array_keys($this->map);
    }

    /**
     * @param string $name
     * @param string $class
     * @return void
     */
    public function addType($name, $class)
    {
        $this->map[$name] = $class;
    }
}
