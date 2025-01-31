# selenuim test with codeception

## Docs
- https://codeception.com/quickstart
- https://codeception.com/docs/AcceptanceTests 

## Getting started

1. `git clone git@gitlab.maxitlab.com:og-dev/selenuim.git`
2. `make start`  |  или напрямую `docker-compose up -d`
3. `make runTest` | или напрямую `vendor/bin/codecept run`  - запуск всех тестов

# Configuration with .env file

## Переменные окружения:
* `TEST_DOMAIN` - домен для подключения (например: https://pos5.lko-dev.fid-team.ru/og)
* `GITHUB_ACCESS_TOKEN` - токет GitHub для установки Composer (создается по [ссылке](https://github.com/settings/tokens/new?scopes=&description=composer_2024))

В тестах используем относительные пути к странице, например так 

- /login

В итоге этот относительный путь будет смаплен с `TEST_DOMAIN` из .env файла, получив нужную страницу:

https://pos5.lko-dev.fid-team.ru/og/login

Если нужно прогнать тесты на другом стенде - меняем TEST_DOMAIN на нужное значение

# !!! На проде не нужно тренироваться !!!

## Директория с логами tests/_output

![img.png](img.png)

## Все тесты пишем в директории /src/tests/Acceptance
внутри этой директории группируем по папкам тесты 
- Например, тесты на авторизацию - группируем в /src/tests/Acceptance/Auth

## У нас есть разделение по ролям, поэтому тесты по ролям должны группироваться тоже, делаем так
  - /src/tests/Acceptance/Auth/Admin  
  - /src/tests/Acceptance/Auth/Federal
  - /src/tests/Acceptance/Auth/Regional
  - /src/tests/Acceptance/Auth/Municipal

Тестам навешиваем группу - https://codeception.com/docs/AdvancedUsage

![img_1.png](img_1.png)

потом будем запускать разные группы тестов 
```bash
# группа тестов для администратора
php vendor/bin/codecept run -g admin
# группа тестов для федерального уполномоченного
php vendor/bin/codecept run -g federal
# группа тестов для регионального уполномоченного
php vendor/bin/codecept run -g regional
# группа тестов для муниципала
php vendor/bin/codecept run -g muinicipal

# для всех ролей 
php vendor/bin/codecept run -g admin -g federal -g regional -g muinicipal

```

# Доступные команды 
- make runTest - запустить тесты
- make start - запустить все контейнеры
- make stop - остановить все контейнеры 
- make ls - выводит список запущенных контейнеров, из числа тех что указаны в docker-compose.yaml
- make stats - откроет статистику докера по потреблению памяти, процессорного времени и тп
- make logs - просто выведет последние логи
- make logsf - откроет логи на просмотр и будет держать открытыми пока не сбросишь сам через ctrl+c
- make connect - провалиться в сам контейрен (подключение к контейнеру с тестами)

Внутри контейнера можно запускать тесты через `./vendor/bin/codecept`

Больше информации о приемочных тестах - [тут](https://codeception.com/docs/GettingStarted)


Создание тестов:

`vendor/bin/codecept generate:cest Acceptance <testname>`
<testname> - название теста, например, AB01_CreatePoll, вследствии чего создастся класс AB01_CreatePollCest

Наименование тестов очень важно, поскольку оно определяет порядок запуска тестов (в алфавитном порядке).
Поэтому лучше следовать примерному формату XYZI, где:

- X - код уполномоченного (A - админ, B - федерал, C - регионал, D - муниципал)
- Y - код сущности (тут неважно, какую букву использовать, но для определенной сущности код должен быть одинаковым, например, для опросов - A)
- ZI - код теста, определяющий порядок запуска. Например, AB01_CreatePoll будет отвечать за создание опроса, если необходимо вынести редактирование в отдельный тест, следующий тест следует назвать AB02_UpdatePoll, либо же все делать в одном классе

Сам порядок запуска тестов в пределах одного класса можно задать, указав атрибут перед классом с названием зависимого теста:

`#[Depends('createPoll')]`

Для определения групп так же следует на каждом тесте указывать атрибут (можно через запятую)

`#[Group('admin')]`

или

`#[Group('admin', 'federal')]`

Следует понимать, что каждый запуск одного теста (класса) подразумевает создание новой сессии, поэтому следует добавлять авторизацию в метод _before:

```php
public function _before(AcceptanceTester $I)
{
    $I->signInAsAdmin();
}
```

Какие-то общие методы хранятся в классе `src/tests/Support/AcceptanceTester.php`
