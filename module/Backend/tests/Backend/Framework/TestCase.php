<?php

namespace BackendTest\Framework;

use PHPUnit_Framework_TestCase;

class BackendControllerTest extends \PHPUnit_Framework_TestCase
{
    public static $locator;

    public static function setLocator($locator)
    {
        self::$locator = $locator;
    }

    public function getLocator()
    {
        return self::$locator;
    }
}
