<?php

namespace Acceptance\admin\news;

use Codeception\Attribute\Depends;
use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class DeleteNewsCest
{
    public $indexRoute = '/news/index';
    public $viewRoute = '/news/view';

    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }
 //   #[Depends('createNews')]
    #[Group('admin')]
    // Удаление новости федерального уровня
    public function deleteNews(AcceptanceTester $I)
    {
        $I->amOnPage($this->viewRoute . '?id=' . $GLOBALS["newsId"]);
        $deleteNewsButton = '//a[contains(@href, "news/delete")]';
        $I->seeElement($deleteNewsButton);
        $I->click($deleteNewsButton);
        $I->wait(4);
        $I->acceptPopup();
        $I->makeScreenshot('news_delete_federal');
    }
}