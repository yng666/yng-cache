<?php
declare(strict_types=1);

namespace Yng\Cache\Handlers;

use Psr\SimpleCache\CacheInterface;

/**
 * @class   AbstractHandler
 * @author  Yng
 * @date    2022/04/25
 * @time    13:24
 * @package Yng\Cache\Handlers
 */
abstract class AbstractHandler implements CacheInterface
{
    /**
     * @var object
     */
    protected object $handler;

    /**
     * 读取缓存
     *
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        $data = $this->handler->get($key);
        return is_null($data) ? value($default) : unserialize((string)$data);
    }

    /**
     * 设置缓存
     *
     * @param string $key
     * @param mixed  $value
     * @param null   $ttl
     *
     * @return bool
     */
    public function set($key, $value, $ttl = null)
    {
        return $this->handler->set($key, serialize($value), $ttl);
    }

    /**
     * 获取多个值
     *
     * @param iterable $keys
     * @param null     $default
     *
     * @return iterable|mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getMultiple($keys, $default = null)
    {
        return array_reduce((array)$keys, function($stack, $key) use ($default) {
            $stack[$key] = $this->has($key) ? $this->get($key) :
                (is_array($default) ? ($default[$key] ?? null) : $default);
            return $stack;
        }, []);
    }

    /**
     * 设置多个
     *
     * @param iterable $values
     * @param null     $ttl
     *
     * @return bool
     */
    public function setMultiple($values, $ttl = null)
    {
        try {
            foreach ((array)$values as $key => $value) {
                $this->set($key, $value, $ttl);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 删除多个
     *
     * @param iterable $keys
     *
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function deleteMultiple($keys)
    {
        try {
            foreach ((array)$keys as $key) {
                $this->delete($key);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
