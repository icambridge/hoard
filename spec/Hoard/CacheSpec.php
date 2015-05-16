<?php

namespace spec\Hoard;

use Hoard\Storage\System;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CacheSpec extends ObjectBehavior
{
    const KEY = "key";
    const DATA = "really expensive data";
    const TTL = 90;

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

        $system->set(self::KEY, self::DATA)->shouldBeCalled();

        $this->get(self::KEY)->shouldReturn(self::DATA);
    }

    function it_sets_data_in_system_when_fetched_from_normal(System $system, System $normal)
    {
        $system->get(self::KEY)->willReturn(null);
        $normal->get(self::KEY)->willReturn(self::DATA);

        $system->set(self::KEY, self::DATA)->shouldBeCalled();

        $this->get(self::KEY);
    }

    function it_always_calls_normal_when_true_flag_given(System $system, System $normal)
    {
        $system->get(self::DATA)->shouldNotBeCalled();
        $normal->get(self::KEY)->willReturn(self::DATA);

        $system->set(self::KEY, self::DATA)->shouldBeCalled();

        $this->get(self::KEY, true)->shouldReturn(self::DATA);
    }

    function it_sets_system_and_normal_cache(System $system, System $normal)
    {
        $system->set(self::KEY, self::DATA, 0)->shouldBeCalled();
        $normal->set(self::KEY, self::DATA, 0)->shouldBeCalled();

        $this->set(self::KEY, self::DATA);
    }

    function it_sets_system_and_normal_cache_with_ttl(System $system, System $normal)
    {
        $system->set(self::KEY, self::DATA, self::TTL)->shouldBeCalled();
        $normal->set(self::KEY, self::DATA, self::TTL)->shouldBeCalled();

        $this->set(self::KEY, self::DATA, self::TTL);
    }

    function it_deletes_cache_item_from_system_and_normal(System $system, System $normal)
    {
        $system->delete(self::KEY)->shouldBeCalled();
        $normal->delete(self::KEY)->shouldBeCalled();

        $this->delete(self::KEY);
    }

    function it_flushes(System $system, System $normal)
    {
        $system->flush()->shouldBeCalled();
        $normal->flush()->shouldBeCalled();

        $this->flush();
    }
}
