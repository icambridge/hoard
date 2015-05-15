<?php

namespace Hoard;

use Hoard\Storage\System;

class Cache
{
    private $system;

    private $superHot;

    private $normal;

    public function __construct(System $system, System $normal)
    {
        $this->system = $system;
        $this->normal = $normal;
    }

    public function get($key, $force = false)
    {
        $result = null;

        if (!$force) {
            $result = $this->system->get($key);
        }

        if (null !== $result) {
            return $result;
        }

        return $this->normal->get($key);
    }

    public function set($argument1, $argument2)
    {
        // TODO: write logic here
    }
}
