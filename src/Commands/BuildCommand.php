<?php
namespace Pharckager\Commands;

use Herrera\Box\Box;
use Herrera\Box\StubGenerator;
use Knight23\Core\Banner\BannerInterface;
use Knight23\Core\Output\WriterInterface;

class BuildCommand extends \Knight23\Core\Command\BaseCommand
{
    /**
     * @var WriterInterface
     */
    private $output;

    /**
     * @var BannerInterface
     */
    private $banner;

    public function __construct(WriterInterface $output, BannerInterface $banner)
    {
        $this->setName("build");
        $this->setShort("build a package from the current or given directory");
        $this->addArgument('path', '.', 'to build from, defaults to .');
        $this->addArgument('pharname', null, 'the name of the phar to build, defaults to directoryname.phar');

        $this->output = $output;
        $this->banner = $banner;
    }

    public function run(array $options, array $arguments)
    {
        $this->output->writeln($this->banner->getBanner());

        if (count($arguments) < 1) {
            $path = ".";
        } else {
            $path = $arguments[0];
        }
        $path = realpath($path);

        if (count($arguments) < 2) {
            $pharname = basename($path).'.phar';
        } else {
            $pharname = $arguments[1];
            if (substr($pharname, -5) !== '.phar') {
                $pharname .= '.phar';
            }
        }

        $this->output->writeln("creating <info>$pharname</info> with contents from <info>$path</info>");

        $box = Box::create($pharname);
        $box->buildFromDirectory($path);
        $box->getPhar()->setStub(
            StubGenerator::create()
                ->index('bin/pharckager')
                ->generate()
        );

        $this->output->writeln("done");
    }
}
