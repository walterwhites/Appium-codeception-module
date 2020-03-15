<?php

namespace Codeception\Module\Appium\Traits;

use PHPUnit_Extensions_AppiumTestCase_Element;

trait TextField
{
    public static $textField = "**/XCUIElementTypeTextField[`value == '%s'`]";

    /**
     * @var PHPUnit_Extensions_AppiumTestCase_Element $action
     */
    public $action;

    public function setText(String $value, $text)
    {
        $element = sprintf(self::$textField, $value);
        $this->action = $this->actionByLocatorStrategy($element);
        $this->action->setImmediateValue($text);
    }
}
