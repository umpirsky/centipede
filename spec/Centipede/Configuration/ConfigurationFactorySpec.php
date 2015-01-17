<?php

namespace spec\Centipede\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigurationFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Centipede\Configuration\ConfigurationFactory');
    }

    function it_creates_configuration()
    {
        $this::create(__DIR__.'/../Fixture/centipede.yml')->shouldHaveType('Centipede\Configuration\Configuration');
    }
}
