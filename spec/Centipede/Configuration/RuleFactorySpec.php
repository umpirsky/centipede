<?php

namespace spec\Centipede\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RuleFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Centipede\Configuration\RuleFactory');
    }

    function it_creates_rule()
    {
        $this::create([])->shouldHaveType('Centipede\Configuration\Rule');
    }
}
