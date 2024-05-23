<?php


namespace Tests\Acceptance;

use Codeception\Util\HttpCode;
use Tests\Support\AcceptanceTester;

class SigninCest
{
    public $route = '/login';
    
    public function _before(AcceptanceTester $I)
    {
    }
    
    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage($this->route);
        
        $I->seeElement('#login-form');
        $I->tryToSee('подсистема обратной связи', 'site-loginText');
        $I->see('Авторизоваться в системе');
        
        // test scenario
        $I->fillField('[name="LoginForm[username]"]', 'admin');
        $I->fillField('[name="LoginForm[password]"]', '12345');
        $I->click('#login-button');
        
        $I->saveSessionSnapshot('login');
        $I->waitForElement('#index-notifications-grid', 4);
        $I->waitForElement('body > main > div > div > div > div > div > div:nth-child(2) > div.index-title', 4);
    }
}
