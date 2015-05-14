<?php

namespace Hoard\Storage;

class Redis implements System
{
    /**
     * @var \Redis
     */
    private $redis;

    /**
     * Redis constructor.
     * @param \Redis $redis
     */
    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    public function set($key, $data, $ttl = 0)
    {
        return $this->redis->set($key, $data, $ttl);
    }

    public function get($key)
    {
        return $this->redis->get($key);
    }

    public function delete($key)
    {
        $this->redis->delete($key);
    }

    public function flush()
    {
        $this->redis->flushAll();
    }
}
