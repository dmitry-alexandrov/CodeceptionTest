<?php


namespace Acceptance\admin\projectContest;

use Codeception\Attribute\Depends;
use Codeception\Attribute\Group;
use Codeception\Attribute\Incomplete;
use Tests\Support\AcceptanceTester;

class CreateProjectContestCest
{
    public $route = '/project-contest/index';

    public $viewRoute = '/project-contest/view';

   // public $id = null;


    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }

    #[Group('admin')]

    // Создание голосования по проектам федерального уровня
    public function testCreateFederalProjectContest(AcceptanceTester $I)
    {
        $I->amOnPage($this->route);
        $createProjectContestButton = ".block-action-buttons > a[href='/og/project-contest/create']";
        $I->seeElement($createProjectContestButton);
        $I->click($createProjectContestButton);
        $I->wait(4);
        // название
        $I->fillField('input[name="ProjectContest[name]"]', 'федеральное голосование по проектам');
        // описание
        $I->fillTextArea('[id="projectcontest-description"]', 'описание голосования по проектам');
        // выбор даты начала
        $I->fillDatePicker('[id="projectcontest-starts_at"]', 1);


        // выбор даты окончания
        $I->fillDatePicker('[id="projectcontest-ends_at"]', 2);


        //Количество возможных голосов
        $I->fillField('[id="projectcontest-choices_amount"]', '1');
        //Количество возможных победителей
        $I->fillField('[id="projectcontest-winners_amount"]', '1');

        $I->click('button[type="submit"]');
        $I->wait(5);
        $GLOBALS["projectContestId"] = (int) explode('=', parse_url($I->getCurrentUrl())['query'])[1];
      //  $this->id = (int) explode('=', parse_url($I->getCurrentUrl())['query'])[1];

        $I->makeScreenshot('projectContest_create_federal');
    }
}
