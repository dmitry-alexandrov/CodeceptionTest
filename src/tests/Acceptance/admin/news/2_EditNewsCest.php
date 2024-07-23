<?php

namespace Acceptance\admin\news;

use Codeception\Attribute\Depends;
use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class EditNewsCest
{
    public $indexRoute = '/news/index';
    public $viewRoute = '/news/view';

    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }

    //   #[Depends('createNews')]
    #[Group('admin')]
    // Редактирование новости федерального уровня
    public function editNews(AcceptanceTester $I)
    {
        if (empty($GLOBALS["newsId"])) {
            $createNewNews=new Acceptance\admin\projectContest\CreateNewsCest();
            $createNewNews ->testCreateFederalNews($I);
        }

        $I->amOnPage($this->viewRoute . '?id=' . $GLOBALS["newsId"]);
        $editNewsButton = ".block-action-buttons > a[href='/og/news/update?id=".$GLOBALS["newsId"]."']";
        $I->seeElement($editNewsButton);
        $I->click($editNewsButton);
        $I->wait(4);
        // редактирование названия
        $I->fillField('[id="news-title_short"]', 'Новости Федеральные. Отредактированное');
        // редактирование описания
        $I->fillTextArea('[id="news-description"]', 'описание новости. Отредактированное');
        $I->click('button[type="submit"]');
        $I->wait(5);
        $I->makeScreenshot('news_edit_federal');
    }

}