<?php

namespace Appium;

use Helper\Appium\interfaces\IClassChainSearch;
use Helper\Appium\interfaces\ILocatorStrategy;
use IosTester;

abstract class Application implements ILocatorStrategy, IClassChainSearch
{
    /* @var IosTester $tester */
    protected $tester;
    /* @var Appium $appium */
    protected $appium;
    /* @var AppTestCase $test */
    protected $test;

    public function __construct(IosTester $iosTester)
    {
        $this->tester = $iosTester;
        $this->appium = Session::getAppium();
        $this->test = Session::getAppTestCase();
    }
    public function getAppium()
    {
        return $this->appium;
    }
    public function getTest()
    {
        return $this->test;
    }
}
