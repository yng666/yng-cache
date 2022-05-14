<?php
declare(strict_types=1);

namespace Yng\Cache;

use Psr\SimpleCache\CacheInterface;

/**
 * @class   Cache
 * @author  Yng
 * @date    2022/04/18
 * @time    23:23
 * @package Yng\Cache
 */
class Cache implements CacheInterface
{
    /**
     * @var CacheInterface
     */
    protected CacheInterface $cache;

    /**
     * @param CacheManager $cacheManager
     */
    public function __construct(CacheManager $cacheManager)
    {
        $this->cache = $cacheManager->store();
    }

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
        return $this->cache->get($key, $default);
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
        return $this->cache->set($key, $value, $ttl);
    }

    /**
     * @param string $key
     *
     * @return bool|void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function delete($key)
    {
        return $this->cache->delete($key);
    }

    /**
     * 清空
     *
     * @return bool|void
     */
    public function clear()
    {
        return $this->cache->clear();
    }

    /**
     * 获取多个值
     *
     * @param iterable $keys 例如[$key1, $key2, ...$keyn]
     * @param null     $default
     *
     * @return iterable|mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getMultiple($keys, $default = null)
    {
        return $this->cache->getMultiple($keys, $default);
    }

    /**
     * 设置多个
     *
     * @param iterable $values
     * 例如[$key => $value]
     * @param null     $ttl
     *
     * @return bool
     */
    public function setMultiple($values, $ttl = null)
    {
        return $this->cache->setMultiple($values, $ttl);
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
        return $this->cache->deleteMultiple($keys);
    }

    /**
     * 判断是否存在
     *
     * @param string $key
     *
     * @return bool|void
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function has($key)
    {
        return $this->cache->has($key);
    }
}
