<?php


namespace Tests\Acceptance\admin\discussion;

use Codeception\Attribute\Group;
use Codeception\Attribute\Incomplete;
use Tests\Support\AcceptanceTester;

class AC01_CreateDiscussionCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }

    // tests

    #[Incomplete]
    #[Group('admin')]
    public function tryToTest(AcceptanceTester $I)
    {
    }
}
