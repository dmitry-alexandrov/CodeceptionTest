<?php

namespace Acceptance\admin\news;

use Codeception\Attribute\Depends;
use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class UnpublishNewsCest
{
    public $indexRoute = '/news/index';
    public $viewRoute = '/news/view';

    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }
 //   #[Depends('publishNews')]
    #[Group('admin')]
    // Снятие с публикации новости федерального уровня
    public function unpublishNews(AcceptanceTester $I)
    {
        $I->amOnPage($this->viewRoute . '?id=' . $GLOBALS["newsId"]);
        $unpublishNewsButton = '//a[contains(@href, "news/unpublish")]';
        $I->seeElement($unpublishNewsButton);
        $I->click($unpublishNewsButton);
        $I->wait(4);
        $I->makeScreenshot('news_unpublish_federal');
    }

}