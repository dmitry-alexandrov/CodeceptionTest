<?php


namespace Tests\Acceptance\admin\poll;

use Codeception\Attribute\Group;
use Codeception\Attribute\Incomplete;
use Tests\Support\AcceptanceTester;

class AB01_CreatePollCest
{
    public $route = '/poll/index';

    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }

    #[Incomplete]
    #[Group('admin')]
    public function testCreateFederalPoll(AcceptanceTester $I)
    {
        $I->amOnPage($this->route);
        $createPollButton = ".block-action-buttons > a[href='/og/poll/create-poll']";
        $I->seeElement($createPollButton);
        $I->click($createPollButton);
        $I->wait(4);

        $I->fillField('input[placeholder="Введите название опроса..."]', 'федеральный опрос');
        $I->fillTextArea('textarea[placeholder="Введите описание опроса..."]', 'описание опроса');
//        $I->click('input[placeholder="Выберите категорию"]');
//        $I->wait(1);
//        $I->click('div.el-select-dropdown__wrap > ul > li:nth-child(2)');

        $I->makeScreenshot('poll_create_federal');
    }
}
