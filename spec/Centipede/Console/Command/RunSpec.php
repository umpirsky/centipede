<?php

namespace spec\Centipede\Console\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RunSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Centipede\Console\Command\Run');
    }
}
