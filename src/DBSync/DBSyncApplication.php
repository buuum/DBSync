<?php

namespace DBSync;

use DBSync\Commands\BackUp;
use DBSync\Commands\Diff;
use DBSync\Commands\Init;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DBSyncApplication extends Application
{

    protected $config_file;

    public function __construct($version = '1.0.0')
    {
        parent::__construct("DBSync: Sync and backup databases from project.", $version);

        $this->addCommands([
            new Init(),
            new BackUp(),
            new Diff()
        ]);
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        // always show the version information except when the user invokes the help
        // command as that already does it
        if (false === $input->hasParameterOption(array('--help', '-h')) && null !== $input->getFirstArgument()) {
            $output->writeln($this->getLongVersion());
            $output->writeln('');
        }

        return parent::doRun($input, $output);
    }

}
