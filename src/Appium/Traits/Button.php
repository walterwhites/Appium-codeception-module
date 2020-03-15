<?php

namespace Codeception\Module\Appium\Traits;

use Codeception\Module\Appium\Interfaces\ILocatorStrategy;
use PHPUnit_Extensions_AppiumTestCase_TouchAction;

trait Button
{
    public static $button = "**/XCUIElementTypeButton[`%s == '%s'`]";
    public static $positionedButton = "**/XCUIElementTypeButton[%s]";

    /**
     * @var PHPUnit_Extensions_AppiumTestCase_TouchAction $action
     */
    public $action;

    /**
     * @param $position
     */
    public function touchPositionedButon($position)
    {
        if ($this->locatorStrategy == ILocatorStrategy::class_chain) {
            $button = sprintf(self::$positionedButton, $position);
            $this->touchElement($button);
        } else {
            throw new \Exception("This method in only available with using class chain strategy");
        }
    }

    public function clickOnButton(String $element, $during = 0)
    {
        if ($this->locatorStrategy == ILocatorStrategy::class_chain) {
            $element = sprintf(self::$button, $this->classChainSearch, $element);
        }
        $el = $this->actionByLocatorStrategy($element);
        $this->action = $this->initiateTouchAction();
        $this->action->tap(['element' => $el])->wait($during)->perform();
    }

    public function clickOnPositionedButton(Int $position, $during = 0)
    {
        $element = sprintf(self::$positionedButton, $position);
        $el = $this->actionByLocatorStrategy($element);
        $this->action = $this->initiateTouchAction();
        $this->action->tap(['element' => $el])->wait($during)->perform();
    }
}
