<?php

namespace Codeception\Module\Appium\Traits;

use PHPUnit_Extensions_AppiumTestCase;
use PHPUnit_Extensions_AppiumTestCase_Element;
use PHPUnit_Extensions_Selenium2TestCase_Element;

trait TextField
{
    public static $textField = "**/XCUIElementTypeTextField[`value == '%s'`]";

    /**
     * @var PHPUnit_Extensions_AppiumTestCase|PHPUnit_Extensions_AppiumTestCase_Element|PHPUnit_Extensions_Selenium2TestCase_Element $action
     */
    public $action;

    public function setText($value, $text)
    {
        $element = sprintf(self::$textField, $value);
        $this->action = $this->actionByLocatorStrategy($element);
        $this->action->setImmediateValue($text);
    }
}
