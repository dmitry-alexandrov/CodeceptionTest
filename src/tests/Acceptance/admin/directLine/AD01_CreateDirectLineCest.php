<?php


namespace Tests\Acceptance\admin\directLine;

use Codeception\Attribute\Depends;
use Codeception\Attribute\Group;
use Codeception\Attribute\Incomplete;
use Tests\Support\AcceptanceTester;

class AD01_CreateDirectLineCest
{
    public $indexRoute = '/direct-line/index';
    public $viewRoute = '/direct-line/view';
    public $id = null;

    public function _before(AcceptanceTester $I)
    {
        $I->signInAsAdmin();
    }

    // tests

    #[Group('admin')]
    public function createDirectLine(AcceptanceTester $I)
    {
        $I->amOnPage($this->indexRoute);
        $createDirectLineButton = ".block-action-buttons > a[href='/og/direct-line/create']";
        $I->seeElement($createDirectLineButton);
        $I->click($createDirectLineButton);
        $I->wait(4);

        // название
        $I->fillField('[id="directline-name"]', 'прямая линия');
        // описание
        $I->fillTextArea('[id="directline-description"]', 'описание прямой линии');
        // выбор первой категории
        $I->click('div.field-directline-category_ids >* span[role="combobox"]');
        $I->click('//*[starts-with(@id, "select2-directline-category_ids-result-")]');
        // url
        $I->fillTextArea('[id="direct-line-links_0_url"]', 'https://google.com');
        // описание ссылки
        $I->fillField('[name="DirectLine[links][0][description]"]', 'google');
        // выбор даты начала приема вопросов
        $I->scrollTo('[id="directline-questions_starts_at"]');
        $I->click('[id="directline-questions_starts_at"]');
        $I->seeElement('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[1]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[1]/div[@class="datetimepicker-days"]//td[@class="day new"]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[1]/div[@class="datetimepicker-hours"]//span[@class="hour"]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[1]/div[@class="datetimepicker-minutes"]//span[@class="minute"]');
        // выбор даты окончания приема вопросов
        $I->scrollTo('[id="directline-questions_ends_at"]');
        $I->click('[id="directline-questions_ends_at"]');
        $I->seeElement('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[2]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[2]/div[@class="datetimepicker-days"]//td[@class="day"]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[2]/div[@class="datetimepicker-hours"]//span[@class="hour"]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[2]/div[@class="datetimepicker-minutes"]//span[@class="minute"]');

        // выбор даты начала
        $I->wait(0.5);
        $I->scrollTo('[id="directline-starts_at"]');
        $I->click('[id="directline-starts_at"]');
        $I->seeElement('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[3]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[3]/div[@class="datetimepicker-days"]//td[@class="day"]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[3]/div[@class="datetimepicker-hours"]//span[@class="hour"]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[3]/div[@class="datetimepicker-minutes"]//span[@class="minute"]');

        // выбор даты окончания
        $I->wait(0.5);
        $I->scrollTo('[id="directline-ends_at"]');
        $I->click('[id="directline-ends_at"]');
        $I->seeElement('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[4]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[4]/div[@class="datetimepicker-days"]//td[@class="day"]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[4]/div[@class="datetimepicker-hours"]//span[@class="hour"]');
        $I->click('(//div[contains(@class, "datetimepicker") and contains(@class, "dropdown-menu")])[4]/div[@class="datetimepicker-minutes"]//span[@class="minute"]');

        // должностное лицо
        $I->fillField('[id="directline-governor_fio"]', 'Иванов Иван Иванович');
        // файл с фотографией
        $I->attachFile('[id="directlinephoto-file"]', 'mountains.jpg');

        $I->click('button[type="submit"]');
        $I->wait(5);

        $this->id = (int) explode('=', parse_url($I->getCurrentUrl())['query'])[1];
    }

    #[Depends('createDirectLine')]
    #[Group('admin')]
    public function publishDirectLine(AcceptanceTester $I)
    {
        $I->amOnPage($this->viewRoute . '?id=' . $this->id);
        $publishDirectLineButton = '//a[contains(@href, "direct-line/publish")]';
        $I->seeElement($publishDirectLineButton);
        $I->click($publishDirectLineButton);
        $I->wait(4);
    }

    #[Incomplete]
    #[Depends('publishDirectLine')]
    #[Group('admin')]
    public function unpublishDirectLine(AcceptanceTester $I)
    {
        $I->amOnPage($this->viewRoute . '?id=' . $this->id);
    }
}
