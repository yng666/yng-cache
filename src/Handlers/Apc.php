<?php

namespace Yng\Cache\Handlers;

use Psr\SimpleCache\CacheInterface;

/**
 * @class   Apc
 * @author  Yng
 * @date    2022/04/25
 * @time    13:24
 * @package Yng\Cache\Handlers
 */
class Apc implements CacheInterface
{
    /**
     * @param     $key
     * @param int $step
     *
     * @return false|int
     */
    public function incr($key, int $step = 1)
    {
        return apc_inc($key, $step);
    }

    /**
     * @param     $key
     * @param int $step
     *
     * @return false|int
     */
    public function decr($key, int $step = 1)
    {
        return apc_dec($key, $step);
    }

    /**
     * @param $key
     * @param $default
     *
     * @return false|mixed|null
     */
    public function get($key, $default = null)
    {
        $data = apc_fetch($key, $success);
        return true === $success ? $data : $default;
    }

    /**
     * @param $key
     * @param $value
     * @param $ttl
     *
     * @return array|bool
     */
    public function set($key, $value, $ttl = null)
    {
        return apc_store($key, $value, $ttl);
    }

    /**
     * @param $key
     *
     * @return bool|string[]
     */
    public function delete($key)
    {
        return apc_delete($key);
    }

    /**
     * @return bool
     */
    public function clear()
    {
        return apc_clear_cache('user');
    }

    /**
     * @param $keys
     * @param $default
     *
     * @return array|false[]|null[]
     */
    public function getMultiple($keys, $default = null)
    {
        return array_map(fn($key) => $this->get($key), $keys);
    }

    /**
     * @param $values
     * @param $ttl
     *
     * @return void
     */
    public function setMultiple($values, $ttl = null)
    {
        foreach ($values as $key => $v) {
            $this->set($key, $v, (int)$ttl);
        }
    }

    /**
     * @param $keys
     *
     * @return void
     */
    public function deleteMultiple($keys)
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }
    }

    /**
     * @param $key
     *
     * @return bool|string[]
     */
    public function has($key)
    {
        return apc_exists($key);
    }

}
