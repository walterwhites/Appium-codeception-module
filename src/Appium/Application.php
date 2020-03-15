<?php

namespace Codeception\Module\Appium;

use Codeception\Module\Appium\Interfaces\ILocatorStrategy;
use Codeception\Module\Appium\Interfaces\IClassChainSearch;
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
