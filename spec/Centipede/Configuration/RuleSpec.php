<?php

namespace spec\Centipede\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RuleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Centipede\Configuration\Rule');
    }
}
