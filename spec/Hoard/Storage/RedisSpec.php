<?php

namespace spec\Hoard\Storage;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RedisSpec extends ObjectBehavior
{
    const KEY = "key";
    const DATA = "Really expensive data";
    const TTL = 90;

    function it_is_a_storage_system()
    {
        $this->shouldHaveType('Hoard\Storage\System');
    }

    function let(\Redis $redis)
    {
        $this->beConstructedWith($redis);
    }

    function it_stores_data(\Redis $redis)
    {
        $returnValue = true;
        $redis->set(self::KEY, self::DATA, self::TTL)->willReturn($returnValue);

        $this->set(self::KEY, self::DATA, self::TTL)->shouldReturn($returnValue);
    }

    function it_returns_data_that_has_been_set(\Redis $redis)
    {
        $redis->get(self::KEY)->willReturn(self::DATA);
        $this->get(self::KEY)->shouldReturn(self::DATA);
    }

    function it_deletes_item_from_cache(\Redis $redis)
    {
        $redis->delete(self::KEY);
        $this->delete(self::KEY);
    }

    function it_flushes_cache(\Redis $redis)
    {
        $redis->flushAll();
        $this->flush();
    }
}
