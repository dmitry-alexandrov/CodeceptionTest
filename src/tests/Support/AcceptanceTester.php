<?php

declare(strict_types=1);

namespace Tests\Support;

use SeleniumTest\tests\Support\helpers\UserHelper;

/**
 * Inherited Methods
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Define custom actions here
     */

    public function signInAsAdmin()
    {
        UserHelper::signIn($this, UserHelper::USER_ADMIN);
    }

    public function signInAsFederal()
    {
        UserHelper::signIn($this, UserHelper::USER_FEDERAL);
    }

    public function signInAsRegional()
    {
        UserHelper::signIn($this, UserHelper::USER_REGIONAL);
    }

    public function signInAsMunicipal()
    {
        UserHelper::signIn($this, UserHelper::USER_MUNICIPAL);
    }

    /**
     * @param $field
     * @param $value
     */
    public function fillTextArea($field, $value)
    {
        $this->executeJs(sprintf("document.querySelector('%s').innerHTML = '%s'", $field, $value));
    }

    /**
     * @return mixed
     */
    public function getCurrentUrl()
    {
        return $this->executeJS("return location.href");
    }

    public function fillDatetimePicker($field, $index, bool $newDay = false)
    {
        $this->scrollTo($field);
        $this->click($field);

        $dayToSelect = $newDay ? 'day new' : 'day';
        $this->seeElement("(//div[contains(@class, 'datetimepicker') and contains(@class, 'dropdown-menu')])[$index]");
        $this->click("(//div[contains(@class, 'datetimepicker') and contains(@class, 'dropdown-menu')])[$index]/div[@class='datetimepicker-days']//td[@class='$dayToSelect']");
        $this->click("(//div[contains(@class, 'datetimepicker') and contains(@class, 'dropdown-menu')])[$index]/div[@class='datetimepicker-hours']//span[@class='hour']");
        $this->click("(//div[contains(@class, 'datetimepicker') and contains(@class, 'dropdown-menu')])[$index]/div[@class='datetimepicker-minutes']//span[@class='minute']");

    }

    public function fillDatePicker($field, bool $newDay = false)
    {
        $this->scrollTo($field);
        $this->click($field);

        $dayToSelect = $newDay ? 'day new' : 'day';
        $this->seeElement("(//div[contains(@class, 'datepicker') and contains(@class, 'dropdown-menu')])");
        $this->click("(//div[contains(@class, 'datepicker') and contains(@class, 'dropdown-menu')])/div[@class='datepicker-days']//td[@class='day']");
    }
}
