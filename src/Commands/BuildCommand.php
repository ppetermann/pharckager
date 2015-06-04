<?php
namespace Pharckager\Commands;

use Knight23\Core\Banner\BannerInterface;
use Knight23\Core\Output\WriterInterface;
use Pharckager\Builder\Packager;

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
        $this->setShort("build a specific package");
        $this->addArgument('path', ' to build from');

        $this->output = $output;
        $this->banner = $banner;
    }

    public function run(array $options, array $arguments)
    {
        $this->output->writeln($this->banner->getBanner());

        if (empty($arguments)) {
            $this->output->write('<error>you have given no argument, what should i build?</error>'."\n");
            die(1);
        }

        $packager = new Packager();

        $output = $this->output;
        $packager->setOutput(
            function ($line) use ($output) {
                $output->write($line);
            }
        );

        $packager->coerceWritable();

        $pharer = $packager->getPharer($arguments[0]);
        if (count($arguments) > 1) {
            $pharer->setTarget($arguments[1]);
        }
        $pharer->build();
    }
}
