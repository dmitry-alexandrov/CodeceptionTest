<?php

namespace Acceptance\admin\projectContest;

use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class DeleteProjectContestCest
{
    public $route = '/project-contest/index';

    public $viewRoute = '/project-contest/view';

    // public $id = null;


    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }
    //  #[Depends('testCreateFederalProjectContest')]
    #[Group('admin')]
    public function testDeleteFederalProjectContest(AcceptanceTester $I)
    {
        $I->amOnPage($this->viewRoute . '?id=' . $GLOBALS["projectContestId"]);
        $deleteProjectContestButton = '//a[contains(@href, "project-contest/delete")]';
        $I->seeElement($deleteProjectContestButton);
        $I->click($deleteProjectContestButton);
        $I->wait(4);
        $I->acceptPopup();
        $I->makeScreenshot('projectContest_delete_federal');
    }
}