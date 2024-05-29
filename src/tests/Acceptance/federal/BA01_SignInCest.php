<?php


namespace Tests\Acceptance\federal;

use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class BA01_SignInCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests

    #[Group('federal')]
    public function tryToTest(AcceptanceTester $I)
    {
        $I->signInAsFederal();
    }
}
