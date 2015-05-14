<?php

namespace Hoard\Storage;

interface System
{
    public function set($key, $data, $ttl = 0);

    public function get($key);

    public function delete($key);

    public function flush();
}
