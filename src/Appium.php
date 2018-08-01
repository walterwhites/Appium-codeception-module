<?php

namespace Codeception\Module;

use Codeception\Module;

class Appium extends Module
{

    public function greet($name)
    {
        $this->debug("Hello {$name}!");
    }
}