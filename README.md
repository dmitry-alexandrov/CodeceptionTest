# selenuim test with codeception

## Docs
- https://codeception.com/quickstart
- https://codeception.com/docs/AcceptanceTests 

## Getting started

1. git clone git@gitlab.maxitlab.com:og-dev/selenuim.git
2. docker-compose up -d - запустится контейнер с браузером google chrome - веб драйвер для тестов
3. vendor/bin/codecept run 

# Configuration with .env file

## Переменные окружения:
TEST_DOMAIN - full domain name for tests, example: https://pos5.lko-dev.fid-team.ru/og

В тестах используем относительные пути к странице, например так 

- /login

В итоге этот относительный путь будет смаплен с TEST_DOMAIN из .env файла
получим нужную страницу:

https://pos5.lko-dev.fid-team.ru/og/login

Если нужно прогнать тесты на другом стенде - меняем TEST_DOMAIN на нужное значение

# !!! На проде не нужно тренироваться !!!

## Директория с логами tests/_output

![img.png](img.png)
