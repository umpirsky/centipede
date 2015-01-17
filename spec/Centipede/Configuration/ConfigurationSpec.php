<?php

namespace spec\Centipede\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Centipede\Configuration\Configuration');
    }
}
