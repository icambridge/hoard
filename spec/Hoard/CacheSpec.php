<?php

namespace spec\Hoard;

use Hoard\Storage\System;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CacheSpec extends ObjectBehavior
{
    const KEY = "key";
    const DATA = "really expensive data";

    function it_is_initializable()
    {
        $this->shouldHaveType('Hoard\Cache');
    }

    function let(System $system, System $normal)
    {
        $this->beConstructedWith($system, $normal);
    }

    function it_returns_data_from_system_cache(System $system)
    {
        $system->get(self::KEY)->willReturn(self::DATA);
        $this->get(self::KEY)->shouldReturn(self::DATA);
    }

    function it_returns_data_from_normal_when_system_is_empty(System $system, System $normal)
    {
        $system->get(self::KEY)->willReturn(null);
        $normal->get(self::KEY)->willReturn(self::DATA);

        $this->get(self::KEY)->shouldReturn(self::DATA);
    }

    function it_always_calls_normal_when_true_flag_given(System $system, System $normal)
    {
        $system->get(self::DATA)->shouldNotBeCalled();
        $normal->get(self::KEY)->willReturn(self::DATA);

        $this->get(self::KEY, true)->shouldReturn(self::DATA);
    }
}
