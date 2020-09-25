<?php

namespace Codeception\Module\Appium\Interfaces;

interface ILocatorStrategy
{
    const class_chain = '-ios class chain';
    const predicate_string = '-ios predicate string';
    const accessibility_id = 'accessibility id';

    public function clickElement($el, $during = 0);
    public function touchElement($element);
}
