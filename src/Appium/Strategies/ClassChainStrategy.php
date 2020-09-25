<?php

namespace Codeception\Module\Appium\Strategies;

use Codeception\Module\Appium\Interfaces\ILocatorStrategy;

class ClassChainStrategy extends LocatorStrategy implements ILocatorStrategy
{
    public function clickElement($el, $during = 0)
    {
        $this->action = $this->by(ILocatorStrategy::class_chain, $el);
        $this->action->initiateTouchAction();
        $this->action->tap(['element' => $el])->wait($during)->perform();
    }

    /**
     * @param $el
     */
    public function touchElement($el)
    {
        $this->action = $this->by(ILocatorStrategy::class_chain, $el);
        $action = $this->initiateTouchAction();
        $action->press(['element' => $el])
            ->release()
            ->perform();
    }

    public function seeElement($el)
    {
        $el = $this->by(ILocatorStrategy::class_chain, $el);
        $this->assertNotNull($el);
    }

    public function scrollEl($originElement, $destinationElement)
    {
        $El1 = $this->by(ILocatorStrategy::class_chain, $originElement);
        $El2 = $this->by(ILocatorStrategy::class_chain, $destinationElement);
        $this->scroll($El1, $El2);
    }
}