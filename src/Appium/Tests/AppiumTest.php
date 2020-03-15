<?php

namespace Codeception\Module\Appium\Tests;

use Codeception\Module\Appium\Appium;
use Codeception\Module\Appium\AppTestCase;
use Codeception\Lib\Di;
use Codeception\Lib\ModuleContainer;
use Dotenv\Exception\InvalidFileException;
use PHPUnit\Exception;
use PHPUnit\Framework\TestCase;

class AppiumTest extends TestCase
{
    private $appium;

    public static $config = [
        'local' => true,
        'port' => 4723,
        'host' => '0.0.0.0',
        'browserName' => '',
        'desiredCapabilities' => [
            'app' => "/Users/julien.saadoun/Code/iOS_App/Stage-iphonesimulator 7.zip",
            #'platformName' => 'iOS',
            'platformName' => 'XCUITest',
            'deviceName' => 'iPhone 8',
            'automationName' => 'XCUITest'
        ],
];

    public function __construct()
    {
        parent::__construct();
        $config = AppTestCase::$browsers;
        $this->appium = new Appium(
            new ModuleContainer(
                new Di(),
                $config
            ),
            $config
        );
    }

    public function testVisitPage()
    {
        $result = $this->appium->visitPage('Page');
        $this->assertInstanceOf(Appium::class, $result);
    }

    public function testVisitPageDoesntExist()
    {
        $result = $this->appium->visitPage('page doesnt exist');
        $this->assertInstanceOf(InvalidFileException::class, $result);
    }

    public function testGetName()
    {
        $this->appium->visitPage('Page');
        $page = $this->appium->getPage();
        $this->assertSame('Page', $page);
    }

    public function testGetNameDoesntExist()
    {
        $page = $this->appium->getPage();
        $this->assertNull($page);
    }

    public function testWithoutConfig()
    {
        /* @var AppTestCase $appTestCase */
        $appTestCase = new AppTestCase();
        $mock = $this->getMockBuilder('ios\pages\Page')
            ->disableOriginalConstructor()
            ->getMock();
        $mock
            ->expects($this->once())
            ->method('getTest')
            ->willReturn($appTestCase);

        $this->appium->setAppiumConfig(null);
        $result = $this->appium->visitPage('Page')->running($mock);

        $this->assertInstanceOf(Exception::class, $result);
    }
}
