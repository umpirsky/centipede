<?php

namespace Centipede\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use GuzzleHttp\Message\FutureResponse;
use Centipede\Crawler;
use Centipede\Configuration\ConfigurationFactory;

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
        $configuration = ConfigurationFactory::create(
            rtrim(getcwd(), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'centipede.yml'
        );

        (new Crawler($input->getArgument('url'), $input->getArgument('depth')))->crawl(function ($url, FutureResponse $response) use ($configuration, $output) {
            $rule = $configuration->getRule($url);

            $tag = 'info';
            if ($rule->getStatus() != $response->getStatusCode()) {
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
