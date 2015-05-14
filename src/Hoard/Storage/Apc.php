<?php

namespace Hoard\Storage;

class Apc implements System
{
    public function set($key, $data, $ttl = 0)
    {
        return apc_store($key, $data, $ttl);
    }

    public function get($key)
    {
        $sucess = true;
        $data = apc_fetch($key, $sucess);
        if (!$sucess) {
            return null;
        }
        return $data;
    }

    public function delete($key)
    {
        apc_delete($key);
    }

    public function flush()
    {
        apc_clear_cache();
    }
}
