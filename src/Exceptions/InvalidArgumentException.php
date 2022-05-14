<?php

namespace Yng\Cache\Exceptions;

use InvalidArgumentException as InvalidArgument;
use Psr\SimpleCache\InvalidArgumentException as PsrCacheInvalidArgument;

/**
 * @class   InvalidArgumentException
 * @author  Yng
 * @date    2022/04/24
 * @time    13:24
 * @package Yng\Cache\Exceptions
 */
class InvalidArgumentException extends InvalidArgument implements PsrCacheInvalidArgument
{
}
