<?php

namespace Codeception\Module\Appium;

use Codeception\Module\Appium\Strategies\LocatorStrategy;

class AppTestCase
{
    private LocatorStrategy $locatorStrategy;

    public function getSession()
    {
        return $this->locatorStrategy->getSession();
    }

    public function setSession($session)
    {
        $this->locatorStrategy->setSession($session);
    }

    public function clickElement($el, $during = 0)
    {
        $this->locatorStrategy->clickElement($el, $during = 0);
    }

    public function seeElement($el)
    {
        $this->locatorStrategy->seeElement($el);
    }

    public function scrollEl($originElement, $destinationElement)
    {
        $this->locatorStrategy->scrollEl($originElement, $destinationElement);
    }

    /*public function wait($during = 0)
    {
        usleep($during);
    }*/
}
