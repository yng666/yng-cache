<?php
declare(strict_types=1);

namespace Yng\Cache\Handlers;

/**
 * @class   Memcached
 * @author  Yng
 * @date    2022/04/25
 * @time    13:24
 * @package Yng\Cache\Handlers
 */
class Memcached extends AbstractHandler
{
    /**
     * 初始化
     * Memcached constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->handler = new \Memcached();
        $this->handler->addServer(
            $config['host'] ?? '127.0.0.1',
            $config['post'] ?? 11211,
            $config['weight'] ?? 0,
        );
    }

    /**
     * 删除Memcached缓存
     *
     * @param string $key
     * 缓存的键
     *
     * @return bool|void
     */
    public function delete($key)
    {
        return $this->handler->delete($key);
    }

    /**
     * 设置缓存
     *
     * @param string   $key
     * @param mixed    $value
     * @param int|null $ttl
     *
     * @return bool
     */
    public function set($key, $value, $ttl = null)
    {
        return $this->handler->set($key, serialize($value), (int)$ttl);
    }

    /**
     * 存在判断
     *
     * @param string $key
     *
     * @return bool|void
     */
    public function has($key)
    {
        $status = $this->handler->get($key);
        return false !== $status && !is_null($status);
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
        return parent::setMultiple($values, (int)$ttl);
    }

    /**
     * 清空
     *
     * @return bool
     */
    public function clear()
    {
        return $this->handler->flush();
    }
}
