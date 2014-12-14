<?php

namespace Centipede\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Centipede\Console\Command\Run;

class Application extends BaseApplication
{
    public function __construct($version)
    {
        parent::__construct('Centipede', $version);

        $this->add(new Run());
    }
}
