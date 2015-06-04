<?php
namespace Pharckager\Commands;

use Humbug\SelfUpdate\Updater;
use Knight23\Core\Banner\BannerInterface;
use Knight23\Core\Command\BaseCommand;
use Knight23\Core\Output\WriterInterface;

class SelfUpdateCommand extends BaseCommand
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
        $this->setName("self-update");
        $this->setShort("update with latest release");

        $this->output = $output;
        $this->banner = $banner;
    }

    public function run(array $options, array $arguments)
    {
        $this->output->writeln($this->banner->getBanner());

        $updater = new Updater(null, false);
        $updater->setStrategy(Updater::STRATEGY_GITHUB);
        $updater->getStrategy()->setPackageName('devedge/pharckager');
        $updater->getStrategy()->setPharName('pharckager.phar');
        $updater->getStrategy()->setCurrentLocalVersion('0.0.0');
        try {
            if ($updater->update()) {
                $this->output->writeln("<info>done!</info>");
            } else {
                $this->output->writeln("no update available");
            }
            exit(0);
        } catch (\Exception $e) {
            $this->output->write("<error>".$e->getMessage()."</error>");
            exit(1);
        }
    }
}
