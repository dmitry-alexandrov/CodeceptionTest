<?php


namespace Tests\Acceptance;

use Codeception\Attribute\Group;
use Codeception\Attribute\Incomplete;
use Tests\Support\AcceptanceTester;

class BasicSignInCest
{
    public $route = '/login';
    
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    #[Incomplete]
    #[Group('admin')]
    public function testAdminUserSignIn(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }

    #[Incomplete]
    #[Group('federal')]
    public function testFederalUserSignIn(AcceptanceTester $I)
    {
        $I->signInAsFederal();
    }

    #[Incomplete]
    #[Group('regional')]
    public function testRegionalUserSignIn(AcceptanceTester $I)
    {
        $I->signInAsRegional();
    }

    #[Incomplete]
    #[Group('municipal')]
    public function testMunicipalUserSignIn(AcceptanceTester $I)
    {
        $I->signInAsMunicipal();
    }
    
    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
}
