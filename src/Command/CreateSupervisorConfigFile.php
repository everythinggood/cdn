<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/27/18
 * Time: 9:15 PM
 */

namespace Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSupervisorConfigFile extends Command
{
    public function configure()
    {
        $this->setName('app:create:supervisor-config')
            ->setDescription('Create supervisor configuration.');
        $this->addOption('code','c',InputOption::VALUE_REQUIRED,'[code]');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

        $code = $input->getOption('code');

        if(!$code){
            throw new \Exception("require [code] params");
        }

        $projectRoot = realpath(__DIR__ . '/../..');
        $configurationRoot = $projectRoot . '/supervisor/conf.d';
        $logRoot = $projectRoot.'/supervisor/logs';
        $fileCode = $configurationRoot . '/'.$code.'.conf';
        $projectName = $code;
        $templateCode =<<<TEMP
[program:{$projectName}_worker]
command=/usr/bin/php {$projectRoot}/bin/sendPackage.php {$code}
autostart=true
autorestart=true
numprocs=1  
redirect_stderr=true
stdout_logfile_maxbytes=20MB
stdout_logfile_backups=20
stdout_logfile={$logRoot}/{$projectName}.log
TEMP;

        file_put_contents($fileCode, $templateCode);

        $output->writeln('create supervisor config successfully!');
    }
}