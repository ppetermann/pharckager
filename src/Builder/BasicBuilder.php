<?php
namespace Pharckager\Builder;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class BasicBuilder implements BuilderInterface
{
    public function __construct()
    {

    }

    public function getFileIterator($path)
    {
        return Finder::create()
            ->files()
            ->ignoreVCS(true)
            ->filter(
                function (SplFileInfo $file) {
                    // we don't include phars to our phar
                    if ($file->getExtension() === "phar") {
                        return false;
                    }

                    return null;
                }
            )
            ->in($path);
    }

    public function getScript($path, $pharName)
    {

    }
}
