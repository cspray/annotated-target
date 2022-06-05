<?php declare(strict_types=1);

namespace Cspray\AnnotatedTarget\Exception;

use Exception as PhpException;
use Throwable;

abstract class Exception extends PhpException implements Throwable {}
