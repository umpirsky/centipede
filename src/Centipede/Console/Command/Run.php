<?php

namespace Centipede\Console\Command;

use GuzzleHttp\Exception\ClientException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use GuzzleHttp\Message\ResponseInterface;
use Centipede\Crawler;

class Run extends Command
{
    private $exitCode = 0;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var integer
     */
    private $depth;

    /**
     * @param string            $url
     * @param ResponseInterface $response
     * @param integer           $depth
     */
    public function handleResponse($url, ResponseInterface $response, $depth)
    {
        try {
            $httpCode = $response->getStatusCode();
        } catch (ClientException $e) {
            $httpCode = $e->getResponse()->getStatusCode();
        }

        if ($httpCode < 300) {
            $tag = 'info';
        } elseif ($httpCode >= 300 && $httpCode < 400) {
            $tag = 'comment';
        } else {
            $tag = 'error';
        }

        $depth = implode(' ', array_fill(0, ($this->depth - $depth), '>'));

        $this->output->writeln(sprintf(
            '<%s>%d</%s> %s %s',
            $tag,
            $httpCode,
            $tag,
            $depth,
            $url
        ));
    }

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
        $this->output = $output;

        $this->depth = $input->getArgument('depth');

        (new Crawler($input->getArgument('url'), $this->depth))->crawl([$this, 'handleResponse']);

        return $this->exitCode;
    }
}
