<?php

namespace Acceptance\admin\news;

use Codeception\Attribute\Depends;
use Codeception\Attribute\Group;
use Tests\Support\AcceptanceTester;

class PublishNewsCest
{
    public $indexRoute = '/news/index';
    public $viewRoute = '/news/view';

    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }
 //   #[Depends('createNews')]
    #[Group('admin')]
    // Публикация новости федерального уровня
    public function publishNews(AcceptanceTester $I)
    {
        $I->amOnPage($this->viewRoute . '?id=' . $GLOBALS["newsId"]);
        $publishNewsButton = '//a[contains(@href, "news/publish")]';
        $I->seeElement($publishNewsButton);
        $I->click($publishNewsButton);
        $I->wait(4);
        $I->makeScreenshot('news_publish_federal');
    }
}