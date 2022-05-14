<?php

namespace Yng\Cache;

use Psr\SimpleCache\CacheInterface;

/**
 * @class   CacheManager
 * @author  Yng
 * @date    2022/04/18
 * @time    23:18
 * @package Yng\CacheManager
 */
class CacheManager
{
    /**
     * 配置
     *
     * @var array
     */
    protected array $config;

    /**
     * @var array
     */
    protected array $handlers = [];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return static
     */
    public static function __new()
    {
        return new static(config('cache'));
    }

    /**
     * @param string $name
     *
     * @return CacheInterface
     */
    public function store(string $name = 'default'): CacheInterface
    {
        if ('default' === $name || !isset($this->config['stores'][$name])) {
            $name = $this->config['default'];
        }
        if (!isset($this->handlers[strtolower($name)])) {
            $config                            = $this->config['stores'][$name];
            $handler                           = $config['handler'];
            $options                           = $config['options'];
            $this->handlers[strtolower($name)] = new $handler($options);
        }
        return $this->handlers[$name];
    }
}
