<?php

namespace Centipede\Console\Command;

use Centipede\Authenticator\SessionAuthenticator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\BrowserKit\Response;
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
                new InputOption('auth-method', null, InputOption::VALUE_OPTIONAL, 'Authentication method'),
                new InputOption('session-name', null, InputOption::VALUE_OPTIONAL, 'Session name', 'PHPSESSID'),
                new InputOption('session-id', null, InputOption::VALUE_OPTIONAL, 'Session id'),
                new InputOption('ignore-url', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Ignore url'),
            ])
            ->setDescription('Runs specifications')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $authenticator = null;

        if ('session' === $input->getOption('auth-method')) {
            $authenticator = new SessionAuthenticator(
                $input->getOption('session-name'),
                $input->getOption('session-id')
            );
        }

        $crawler = new Crawler(
            $input->getArgument('url'),
            $input->getArgument('depth'),
            $authenticator
        );

        $excludeUrls = $input->getOption('ignore-url');

        $crawler->crawl(function ($url, Response $response) use ($excludeUrls, $output) {
            $tag = 'info';

            if (in_array($url, $excludeUrls)) {
                return;
            }

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
