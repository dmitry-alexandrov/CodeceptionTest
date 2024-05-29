<?php


namespace Tests\Acceptance\federal;

use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class CA01_SignInCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests

    #[Group('regional')]
    public function tryToTest(AcceptanceTester $I)
    {
        $I->signInAsRegional();
    }
}
