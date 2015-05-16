<?php

namespace Hoard;

use Hoard\Storage\System;

class Cache implements System
{
    /**
     * @var System
     */
    private $system;

    /**
     * @var System
     */
    private $normal;

    /**
     * @param System $system
     * @param System $normal
     */
    public function __construct(System $system, System $normal)
    {
        $this->system = $system;
        $this->normal = $normal;
    }

    /**
     * @param string $key
     * @param bool $force
     * @return null
     */
    public function get($key, $force = false)
    {
        $result = null;

        if (!$force) {
            $result = $this->system->get($key);
        }

        if (null !== $result) {
            return $result;
        }

        $data = $this->normal->get($key);

        $this->system->set($key, $data);

        return $data;
    }

    /**
     * @param string $key
     * @param string $data
     * @param int $ttl
     */
    public function set($key, $data, $ttl = 0)
    {
        $this->system->set($key, $data, $ttl);
        $this->normal->set($key, $data, $ttl);
    }

    public function delete($key)
    {
        $this->system->delete($key);
        $this->normal->delete($key);
    }

    public function flush()
    {
        $this->system->flush();
        $this->normal->flush();
    }
}
