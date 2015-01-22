<?php

namespace Centipede\Console\Command;

use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Centipede\Crawler;

class Run extends Command
{
    private $exitCode = 0;

    protected function configure()
    {
        $this
            ->setName('run')
            ->setDefinition([
                new InputArgument('url', InputArgument::REQUIRED, 'Base url'),
                new InputArgument('depth', InputArgument::OPTIONAL, 'Depth', 1),
            ])
            ->setDescription('Runs specifications')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (new Crawler($input->getArgument('url'), $input->getArgument('depth')))->crawl(function ($url, Response $response) use ($output) {
            $tag = 'info';
            if (200 != $response->getStatus()) {
                $this->exitCode = 1;
                $tag = 'error';
            }

            $output->writeln(sprintf(
                '<%s>%d</%s> %s',
                $tag,
                $response->getStatus(),
                $tag,
                $url
            ));
        });

        return $this->exitCode;
    }
}
