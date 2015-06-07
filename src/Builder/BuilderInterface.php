<?php
namespace Pharckager\Builder;

interface BuilderInterface
{
    /**
     * @param string $path
     * @return \Symfony\Component\Finder\Finder
     */
    public function getFileIterator($path);

    /**
     * @param string $path
     * @param string $pharName
     * @return string
     */
    public function getScript($path, $pharName);
}
