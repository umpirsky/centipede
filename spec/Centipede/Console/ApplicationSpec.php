<?php

namespace spec\Centipede\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1.0);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Centipede\Console\Application');
    }
}
