<?php

namespace spec\Hoard\Storage;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApcSpec extends ObjectBehavior
{
    const KEY = "key";
    const DATA = "Really expensive data";

    function it_is_a_storage_system()
    {
        $this->shouldHaveType('Hoard\Storage\System');
    }

    function it_stores_data()
    {
        $this->set(self::KEY, self::DATA)->shouldReturn(true);
    }

    function it_returns_data_that_has_been_set()
    {
        $this->set(self::KEY, self::DATA);
        $this->get(self::KEY)->shouldReturn(self::DATA);
    }

    function it_deletes_item_from_cache()
    {
        $this->set(self::KEY, self::DATA);
        $this->delete(self::KEY);
        $this->get(self::KEY)->shouldReturn(null);
    }

    function it_flushes_cache()
    {
        $this->set(self::KEY, self::DATA);
        $this->flush();
        $this->get(self::KEY)->shouldReturn(null);
    }
}
