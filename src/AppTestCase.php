<?php
namespace Helper\Appium;

use \PHPUnit_Extensions_AppiumTestCase as TestCase;
use Helper\Appium\interfaces\IClassChainSearch;
use Helper\Appium\interfaces\ILocatorStrategy;
use Helper\Appium\Traits\Button;
use Helper\Appium\Traits\TextField;
use PHPUnit_Extensions_AppiumTestCase;

class AppTestCase extends TestCase implements ILocatorStrategy, IClassChainSearch
{
    public static $browsers;

    /**
     * @var PHPUnit_Extensions_AppiumTestCase $action
     */
    private $actions;

    protected $locatorStrategy = ILocatorStrategy::class_chain;
    protected $classChainSearch = IClassChainSearch::label;

    use Button;
    use TextField;

    public function setLocatorStrategy($locatorStrategy)
    {
        switch ($locatorStrategy) {
            case ILocatorStrategy::class_chain:
                $this->locatorStrategy = ILocatorStrategy::class_chain;
                break;
            case ILocatorStrategy::predicate_string:
                $this->locatorStrategy = ILocatorStrategy::predicate_string;
                break;
            case ILocatorStrategy::accessibility_id:
                $this->locatorStrategy = ILocatorStrategy::accessibility_id;
                break;
        }
    }

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
     * @return PHPUnit_Extensions_AppiumTestCase $el
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

    /**
     * @param $element
     */
    protected function touchElement($element)
    {
        $el = $this->by('-ios class chain', $element);
        $action = $this->initiateTouchAction();
        $action->press(['element' => $el])
            ->release()
            ->perform();
    }

    public function getSession()
    {
        return $this->session;
    }

    public function setSession($session)
    {
        $this->session = $session;
    }

    public function clickElement($el, $during = 0)
    {
        $this->action = $this->actionByLocatorStrategy($el);
        $this->action->initiateTouchAction();
        $this->action->tap(['element' => $el])->wait($during)->perform();
    }

    public function seeElement($id)
    {
        $el = $this->by('-ios class chain', $id);
        $this->assertNotNull($el);
    }

    public function scrollEl($originElement, $destinationElement)
    {
        $El1 = $this->by('-ios class chain', $originElement);
        $El2 = $this->by('-ios class chain', $destinationElement);
        $this->scroll($El1, $El2);
    }

    /*public function wait($during = 0)
    {
        usleep($during);
    }*/
}
