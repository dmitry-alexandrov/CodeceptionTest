<?php


namespace SeleniumTest\tests\Support\helpers;


use Tests\Support\AcceptanceTester;

class UserHelper
{
    public const USER_ADMIN = 'admin';
    public const USER_FEDERAL = 'federal';
    public const USER_REGIONAL = 'regional';
    public const USER_MUNICIPAL = 'municipal';

    public static function getCredentials(string $userType): ?object
    {
        return match ($userType) {
            self::USER_ADMIN => (object)[
                'username' => $_ENV['USER_ADMIN_LOGIN'],
                'password' => $_ENV['USER_ADMIN_PASSWORD'],
            ],
            self::USER_FEDERAL => (object)[
                'username' => $_ENV['USER_FEDERAL_LOGIN'],
                'password' => $_ENV['USER_FEDERAL_PASSWORD'],
            ],
            self::USER_REGIONAL => (object)[
                'username' => $_ENV['USER_REGIONAL_LOGIN'],
                'password' => $_ENV['USER_REGIONAL_PASSWORD'],
            ],
            self::USER_MUNICIPAL => (object)[
                'username' => $_ENV['USER_MUNICIPAL_LOGIN'],
                'password' => $_ENV['USER_MUNICIPAL_PASSWORD'],
            ],
            default => null,
        };
    }

    public static function signIn(AcceptanceTester $I, string $userType)
    {
        $I->amOnPage('/login');
        if (!$I->tryToSeeElement('#login-form')) {
            $I->tryToResetCookie('_csrf-backend');
            $I->tryToResetCookie('_identity-backend');
            $I->amOnPage('/login');
        }

        $user = self::getCredentials($userType);

        $I->seeElement('#login-form');
        $I->see('Авторизоваться в системе');

        $I->fillField('[name="LoginForm[username]"]', $user->username);
        $I->fillField('[name="LoginForm[password]"]', $user->password);
        $I->click('#login-button');

        $I->saveSessionSnapshot('login');
        $I->waitForElement('#index-notifications-grid', 4);
    }
}