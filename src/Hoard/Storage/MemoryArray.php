<?php

namespace Hoard\Storage;

class MemoryArray implements System
{
    /**
     * @var array
     */
    private $cachedData = [];

    /**
     * @param string $key
     * @param mixed $data
     * @param int|null $ttl
     */
    public function set($key, $data, $ttl = 0)
    {
        $this->cachedData[$key] = $data;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (!isset($this->cachedData[$key]) ) {
            return null;
        }

        return $this->cachedData[$key];
    }

    /**
     * @param string $key
     */
    public function delete($key)
    {
        unset($this->cachedData[$key]);
    }

    public function flush()
    {
        $this->cachedData = [];
    }
}
