# Appium-codeception-module

## usage
Below an example of registerByEmail method in RegisterPage

```php
/**
 * @group register
 * Tests the sign up
 * @param User $params
 */
public function registerByEmail(User $params)
{
    $this->test->clickOnButton('SIGN UP', 400);
    $this->test->clickOnButton('SIGN UP WITH EMAIL', 400);
    $this->test->setText('First name', $params->firstName);
    $this->test->setText('Last name', $params->lastName);
    $this->test->setText('Email address', $params->email);
    $this->test->hideKeyboard();
    sleep(2);
    $this->test->touchPositionedButon(2);
    sleep(2);
    $this->test->touchPositionedButon(3);
    $this->test->clickOnButton('SIGN UP', 300);
}
```

- clickOnButton clicks on the button with label 'SIGN UP' then 'SIGN UP WITH EMAIL'
- setText updates the text field with value 'First name' to $params->firstName
- hideKeyboard closes the Keyboard (not working on all iOS devices)
- touchPositionedButon taps on a button or checkbox according his position

## AppTestCase.php

```php
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
```

### ILocatorStrategy interface

default locatorStrategy is class chain, you can override it with the following statement
```php
$this->test->setLocatorStrategy(ILocatorStrategy::accessibility_id);
```

### IClassChainSearch interface

IClassChainSearch is an interface which defines the way to search element in the class chain pattern, for example to search a button
```php
public static $button = "**/XCUIElementTypeButton[%s == '%s']";
```

default value defined in AppTestCase is label, so each time clickOnButton is called, the previous statement becomes
```php
public static $button = "**/XCUIElementTypeButton['label' == '%s']";
```

you can override it with the following statement
```php
$this->test->setClassChainSearch(IClassChainSearch::name);

OR

$this->test->setClassChainSearch(IClassChainSearch::value);
```

full example here
```php
$this->test->clickOnButton('SIGN UP', 400);
$this->test->setLocatorStrategy("name");
$this->test->clickOnButton('button_name', 400);
$this->test->setLocatorStrategy("value");
$this->test->clickOnButton('button_value', 400);
```

- the first clickOnButton clicks on button with label  'SIGN UP'
- the second clickOnButton clicks on button with name  'button_name'
- the third clickOnButton clicks on button with value  'button_value'

The second parameter of clickOnButton defines the time in ms before to perform the action