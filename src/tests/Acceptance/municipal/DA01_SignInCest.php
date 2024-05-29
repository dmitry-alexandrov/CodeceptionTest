<?php


namespace Tests\Acceptance\federal;

use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class DA01_SignInCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests

    #[Group('municipal')]
    public function tryToTest(AcceptanceTester $I)
    {
        $I->signInAsMunicipal();
    }
}
