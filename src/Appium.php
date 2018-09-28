<?php

namespace Codeception\Module;

use Codeception\Module as CodeceptionModule;

class Appium extends CodeceptionModule
{
    protected $config = [
        'host' => '0.0.0.0',
        'local' => true,
        'port' => 4723,
        'browserName' => '',
        'resetAfterSuite' => true,
        'resetAfterCest' => false,
        'resetAfterTest' => false,
        'resetAfterStep' => false,
        'desiredCapabilities' => array(
            'platformName' => 'iOS',
            'platformVersion' => '11.2',
            'deviceName' => 'iPhone 8',
            'xcodeOrgId' => '',
            'xcodeSigningId' => 'iPhone Developer',
            'noReset' => true,
            'fullReset' => false,
            'clearSystemFiles' => true,
            'automationName' => 'XCUITest',
            'bundleId' => 'com.openclassrooms.openclassrooms',
            'showIOSLog' => false
        )
    ];

    public function greet($name)
    {
        $this->debug("Hello {$name}!");
    }
}