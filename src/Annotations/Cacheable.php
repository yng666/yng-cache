<?php

namespace Yng\Cache\Annotations;

use Yng\Di\Annotations\Annotation;
use Psr\SimpleCache\CacheInterface;

/**
 * @class   Cacheable
 * @author  Yng
 * @date    2022/04/25
 * @time    13:25
 * @package Yng\Cache\Annotations
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
class Cacheable extends Annotation
{
    /**
     * 过期时间
     *
     * @var int
     */
    protected int $ttl;

    /**
     * @param          $key
     * @param \Closure $closure
     *
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function handle($key, \Closure $closure)
    {
        /** @var CacheInterface $cache */
        $cache = make(CacheInterface::class);
        if (!$cache->has($key)) {
            $cache->set($key, $closure(), $this->ttl);
        }

        return $cache->get($key);
    }
}
