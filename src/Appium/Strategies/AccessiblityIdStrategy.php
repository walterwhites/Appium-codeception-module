<?php

namespace Codeception\Module\Appium\Strategies;

use Codeception\Module\Appium\Interfaces\ILocatorStrategy;

class AccessiblityIdStrategy extends LocatorStrategy implements ILocatorStrategy
{
    public function clickElement($el, $during = 0)
    {
        $this->action = $this->by(ILocatorStrategy::accessibility_id, $el);
        $this->action->initiateTouchAction();
        $this->action->tap(['element' => $el])->wait($during)->perform();
    }

    /**
     * @param $el
     */
    public function touchElement($el)
    {
        $this->action = $this->by(ILocatorStrategy::accessibility_id, $el);
        $action = $this->initiateTouchAction();
        $action->press(['element' => $el])
            ->release()
            ->perform();
    }

    public function seeElement($el)
    {
        $el = $this->by(ILocatorStrategy::accessibility_id, $el);
        $this->assertNotNull($el);
    }

    public function scrollEl($originElement, $destinationElement)
    {
        $El1 = $this->by(ILocatorStrategy::accessibility_id, $originElement);
        $El2 = $this->by(ILocatorStrategy::accessibility_id, $destinationElement);
        $this->scroll($El1, $El2);
    }
}