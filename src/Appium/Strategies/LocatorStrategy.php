<?php

namespace Codeception\Module\Appium\Strategies;

use Codeception\Module\Appium\Interfaces\IClassChainSearch;
use Codeception\Module\Appium\Interfaces\ILocatorStrategy;
use Codeception\Module\Appium\Traits\Button;
use Codeception\Module\Appium\Traits\TextField;
use \PHPUnit_Extensions_AppiumTestCase as TestCase;
use PHPUnit_Extensions_AppiumTestCase;

class LocatorStrategy extends TestCase
{
    public static $browsers;

    /**
     * @var PHPUnit_Extensions_AppiumTestCase $action
     */
    protected $actions;

    protected $locatorStrategy = ILocatorStrategy::class_chain;
    protected $classChainSearch = IClassChainSearch::label;

    use Button;
    use TextField;

    public function setClassChainSearch($classChainSearch)
    {
        switch ($classChainSearch) {
            case IClassChainSearch::label:
                $this->locatorStrategy = IClassChainSearch::label;
                break;
            case IClassChainSearch::name:
                $this->locatorStrategy = IClassChainSearch::name;
                break;
            case IClassChainSearch::value:
                $this->locatorStrategy = IClassChainSearch::value;
                break;
        }
    }

    /**
     * @param $element
     * @return PHPUnit_Extensions_AppiumTestCase|\PHPUnit_Extensions_AppiumTestCase_Element|\PHPUnit_Extensions_Selenium2TestCase_Element
     */
    public function actionByLocatorStrategy($element)
    {
        switch ($this->locatorStrategy) {
            case ILocatorStrategy::class_chain:
                $el = $this->by('-ios class chain', $element);
                break;
            case ILocatorStrategy::predicate_string:
                $el = $this->by('-ios predicate string', $element);
                break;
            case ILocatorStrategy::accessibility_id:
                $el = $this->by('accessibility id', $element);
                break;
        }
        return $el;
    }

    /**
     * @param $action
     * @param $options
     */
    protected function addAction($action, $options)
    {
        $gesture = [
            'action' => $action,
            'options' => $options
        ];
        $this->actions[] = $gesture;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function setSession($session)
    {
        $this->session = $session;
    }
}