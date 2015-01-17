<?php

namespace Centipede\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Centipede\Console\Command\Run;

class Application extends BaseApplication
{
    public function __construct($version)
    {
        parent::__construct('Centipede', $version);

        $this->add(new Run());
    }

    protected function getCommandName(InputInterface $input)
    {
        return 'run';
    }

    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}
