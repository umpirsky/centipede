<?php

namespace Centipede\Console\Command;

use GuzzleHttp\Message\FutureResponse;
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
        (new Crawler($input->getArgument('url'), $input->getArgument('depth')))->crawl(function ($url, FutureResponse $response) use ($output) {
            $tag = 'info';
            if (200 != $response->getStatusCode()) {
                $this->exitCode = 1;
                $tag = 'error';
            }

            $output->writeln(sprintf(
                '<%s>%d</%s> %s',
                $tag,
                $response->getStatusCode(),
                $tag,
                $url
            ));
        });

        return $this->exitCode;
    }
}
