<?php


namespace Tests\Acceptance\admin;

use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class AA01_SignInCest
{
    public $route = '/login';

    public function _before(AcceptanceTester $I)
    {
    }

    // tests

    #[Group('admin')]
    public function tryToTest(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }
}
