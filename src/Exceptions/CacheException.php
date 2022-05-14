<?php
declare(strict_types=1);

namespace Yng\Cache\Exceptions;

use Exception;
use Psr\SimpleCache\CacheException as PsrCacheException;

/**
 * @class   CacheException
 * @author  Yng
 * @date    2022/04/24
 * @time    13:24
 * @package Yng\Cache\Exceptions
 */
class CacheException extends Exception implements PsrCacheException
{

}
