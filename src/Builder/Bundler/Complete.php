<?php

namespace Pharckager\Builder\Bundler;

use Pharckager\Builder\Bundle;
use Pharckager\Builder\Logger;
use Pharckager\Builder\Package;

use Symfony\Component\Finder\Finder;

class Complete implements BundlerInterface
{
    /**
     * package the bundler is for
     *
     * @type  Package
     */
    private $package;

    /**
     *
     * @type  Logger
     */
    private $logger;

    public function __construct(Package $package, Logger $logger)
    {
        $this->package = $package;
        $this->logger  = $logger;
    }
    /**
     * returns a bundle
     *
     * @return  Bundle
     */
    public function bundle()
    {
        $bundle = new Bundle();
        $iterator = Finder::create()
            ->files()
            ->ignoreVCS(true)
            ->filter($this->package->getBlacklistFilter())
            ->exclude($this->package->getPathVendor())
            ->in($this->package->getDirectory());
        $this->logger->log('    Adding whole project directory "' . $this->package->getDirectory() . '"');
        return $bundle->addDir($iterator);
    }
}