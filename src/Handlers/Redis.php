<?php
declare(strict_types=1);

namespace Yng\Cache\Handlers;

/**
 * @class   Redis
 * @author  Yng
 * @date    2022/04/25
 * @time    13:24
 * @package Yng\Cache\Handlers
 */
class Redis extends AbstractHandler
{
    /**
     * 初始化
     * Redis constructor.
     *
     * @param array $config
     *
     * @throws \Exception
     */
    public function __construct(array $config)
    {
        $this->handler = new \Yng\Redis\Redis($config);
    }

    /**
     * 删除一个缓存
     *
     * @param string $key
     * 标量的key
     *
     * @return bool|void
     */
    public function delete($key)
    {
        return $this->handler->del($key) ? true : false;
    }

    /**
     * 存在判断
     *
     * @param string $key
     *
     * @return bool|int
     */
    public function has($key)
    {
        return (bool)$this->handler->exists($key);
    }

    /**
     * 删除所有缓存
     *
     * @return bool|void
     */
    public function clear()
    {
        return $this->handler->flushAll();
    }
}
