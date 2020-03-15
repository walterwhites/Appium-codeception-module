<?php

namespace Codeception\Module\Appium;

use \PHPUnit\Framework\Exception;
use Codeception\TestInterface;
use Dotenv\Exception\InvalidFileException;

class Appium extends \Codeception\Module
{
    private $completeOutput;
    private $page;

    /* @var AppTestCase $test */
    private $test;
    private $session;

    /**
     * @param mixed $page
     * @return $this|InvalidFileException
     */
    public function visitPage($page)
    {
        if (class_exists('\ios\pages\\' . $page)) {
            $class = $page;
            $this->page = $this->getName($class);
            return $this;
        } else {
            return new InvalidFileException();
        }
    }

    public function launch()
    {
        $this->test->launchApp();
    }

    public function close()
    {
        $this->test->closeApp();
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param $class
     * @return mixed
     */
    private function getName($class)
    {
        $path = explode('\\', $class);
        return array_pop($path);
    }

    /**
     * @param null $key
     * @return array
     */
    public function getAppiumConfig($key = null)
    {
        return $this->config;
    }

    /**
     * @param $config
     * @return array
     * @internal param null $key
     */
    public function setAppiumConfig($config)
    {
        $this->config = $config;
        return $this->config;
    }

    /**
     * @return null|Exception
     */
    public function running($page)
    {
        try {
            if ($this->session == null) {
                try {
                    $this->test = $page->getTest();
                    $this->test->setHost($this->config["host"]);
                    $this->test->setPort($this->config["port"]);
                    $this->test->setBrowser("");
                    $this->test->setDesiredCapabilities($this->config["desiredCapabilities"]);
                    $this->test->prepareSession();
                    $this->session = $this->test->getSession();
                    Session::setAppium($this);
                } catch (Exception $e) {
                    return $e;
                }
            } else {
                $this->test->setSession($this->session);
            }
            return null;
        } catch (Exception $e) {
            $debugFile = 'debug_ios';
            print "You can see full debug logs in _output/debug_ios\n";
            file_put_contents($debugFile, print $e->getMessage());
            return $e;
        }
    }

    /**
     * @param TestInterface $test
     * @param \Exception $fail
     */
    public function _failed(TestInterface $test, $fail)
    {
        parent::_failed($test, $fail);
        $errorColor = escapeshellcmd('\n\033[1;31m' . $this->completeOutput .'\033[0m\n');
        $result = shell_exec('echo ' . $errorColor);

        print $result;
    }

    /**
     * @param TestInterface $test
     */
    public function _before(TestInterface $test)
    {
        parent::_before($test);
        $result = shell_exec('lsof -n -i:4723 | grep LISTEN');
        if ($result == null) {
            $errorColor = escapeshellcmd('\n\033[1;31m Please Start your Appium server \033[0m\n');
            $result = shell_exec('echo ' . $errorColor);
            print $result;
        }
    }

    public function _after(TestInterface $test)
    {
        parent::_after($test);
    }
}
