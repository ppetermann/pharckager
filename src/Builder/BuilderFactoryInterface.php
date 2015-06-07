<?php
namespace Pharckager\Builder;

interface BuilderFactoryInterface
{
    /**
     * @return BuilderInterface
     */
    public function getBuilderFor($type);

    /**
     * @return string[]
     */
    public function getTypes();

    /**
     * @param string $name
     * @param string $class
     * @return void
     */
    public function addType($name, $class);
}
