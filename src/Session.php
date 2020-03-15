<?php

namespace Appium;

class Session
{
    private static $appTestCase;
    private static $appium;

    public static function getAppTestCase()
    {
        if (!self::$appTestCase) {
            self::$appTestCase = new AppTestCase();
        }
        return self::$appTestCase;
    }
    public static function setAppium($appium)
    {
        self::$appium = $appium;
        return self::$appium;
    }
    public static function getAppium()
    {
        return self::$appium;
    }
    public static function setAppTestCase($appTestCase)
    {
        self::$appTestCase = $appTestCase;
        return self::$appTestCase;
    }
}
