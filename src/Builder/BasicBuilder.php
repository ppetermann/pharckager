<?php
namespace Pharckager\Builder;

use Knight23\Core\Output\WriterInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class BasicBuilder implements BuilderInterface
{
    /**
     * @var WriterInterface
     */
    protected $output;

    public function __construct(WriterInterface $output)
    {
        $this->output = $output;
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
        $filename = substr($pharName, 0, -5);

        $plausiblePathes = [
            '' . $filename,
            'bin/' . $filename,
            '' . $filename . '.php',
            'bin/' . $filename . '.php'
        ];

        $this->output->writeln("trying to find bin script to make phar run able");
        foreach($plausiblePathes as $plausiblePath)
        {
            $this->output->write("-> checking for <info>$plausiblePath</info>: ");
            if(file_exists($path . '/' . $plausiblePath)) {
                $this->output->write("found!\n");
                return $plausiblePath;
            }
            $this->output->write(" not found.\n");
        }

        throw new \Exception('could not find a script to run within the phar..');
    }
}
