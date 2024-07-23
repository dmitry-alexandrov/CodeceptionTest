<?php

namespace Acceptance\admin\projectContest;

use Codeception\Attribute\Depends;
use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class EditProjectContestCest
{

    public $route = '/project-contest/index';

    public $viewRoute = '/project-contest/view';


    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }
  //  #[Depends('testCreateFederalProjectContest')]
    #[Group('admin')]

    // Редактирование голосования по проектам федерального уровня
    public function testEditFederalProjectContest(AcceptanceTester $I)
    {
        if (empty($GLOBALS["projectContestId"])) {
            $createNewProjectContest=new Acceptance\admin\projectContest\CreateProjectContestCest();
            $createNewProjectContest ->testCreateFederalProjectContest($I);
        }
        $I->amOnPage($this->viewRoute . '?id=' . $GLOBALS["projectContestId"]);
        $editProjectContestButton = ".block-action-buttons > a[href='/og/project-contest/update?id=".$GLOBALS["projectContestId"]."']";
        $I->seeElement($editProjectContestButton);
        $I->click($editProjectContestButton);
        $I->wait(4);
        // редактируем название
        $I->fillField('input[name="ProjectContest[name]"]', 'федеральное голосование по проектам. Отредактированный ');
        // редактируем описание
        $I->fillTextArea('[id="projectcontest-description"]', 'описание голосования по проектам. Отредактированный');

        $I->click('button[type="submit"]');
        $I->wait(5);
        $GLOBALS["projectContestId"] = (int) explode('=', parse_url($I->getCurrentUrl())['query'])[1];
        //$this->id = (int) explode('=', parse_url($I->getCurrentUrl())['query'])[1];

        $I->makeScreenshot('projectContest_edit_federal');
    }
}