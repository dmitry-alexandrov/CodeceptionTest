<?php


namespace Acceptance\admin\news;

use Codeception\Attribute\Depends;
use Codeception\Attribute\Group;
use Codeception\Attribute\Incomplete;
use Tests\Support\AcceptanceTester;

class CreateNewsCest
{
    public $indexRoute = '/news/index';
    public $viewRoute = '/news/view';
    public $id = null;

    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }

    // tests

    #[Group('admin')]

    // Создание новости федерального уровня
    public function createNews(AcceptanceTester $I)
    {
        $I->amOnPage($this->indexRoute);
        $createNewsButton = ".block-action-buttons > a[href='/og/news/create']";
        $I->seeElement($createNewsButton);
        $I->click($createNewsButton);
        $I->wait(4);

        // название
        $I->fillField('[id="news-title_short"]', 'Новости Федеральные');
        // описание
        $I->fillTextArea('[id="news-description"]', 'описание новости');
        // выбор даты начала публикации
        $I->fillDatePicker('[id="news-published_at"]', 1);


        // выбор даты завершения публикации
        $I->fillDatePicker('[id="news-finished_at"]', 2);

        $I->click('button[type="submit"]');
        $I->wait(5);
        $GLOBALS["newsId"] = (int) explode('=', parse_url($I->getCurrentUrl())['query'])[1];
    }
}
