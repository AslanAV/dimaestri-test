# Тестовое DiMaestri

В этой задаче необходимо автоматизировать начисление скидочных баллов по мере поступления заказов и их изменений. При оценке результата в первую очередь учитывается понимание экосистемы Laravel.
В экосистеме Laravel

1. Развернуть Laravel
2. Создать `route` c адресом `/api/insales/scores/update`
3. На маршрут приходит POST-запрос с заказом в JSON-формате
```php
$request = [
    'id' => 12345,
    'client_id' => 54321
    'items' => [
        [
            'article' => '3005-12',
            'name' => "Сосиська в тесте",
            'price' => 100,
            'quantity' => 12
        ],
        [
            'article' => '3005-13',
            'name' => "Дырка от бублика",
            'price' => 340,
            'quantity' => 3
        ],
        [
            'article' => '3005-14',
            'name' => "Усы Фредди Меркьюри",
            'price' => 900,
            'quantity' => 90
        ],
    ],
    'status' => 'new'
];
```

4. Если в заказе есть скидочный товар "Дырка от бублика" (3005-13), то вернуть JSON
```php
$response = [
   'client_id' => ...,
   'scores' => //3 балла с каждой единицы скидочного товара,
   'order_id' => ...
];
```   

5. Если в заказе нет скидочного товара, то поле scores = 0
6. $response и $request сохранять в бд MySQL. В случае, если заказ и его баллы были уже созданы в БД, то обновлять их.
7. Написать консольную команду, которая раз в 30 минут собирает все заказы со статусом 'accepted' и меняет на статус 'shipping'
8. Свой вариант залить на github и прислать ссылку проверяющему

API адрес (local), метод POST
```bash
http://localhost/api/insales/scores/update
```

[Тесты API](https://github.com/AslanAV/dimaestri-test/blob/main/tests/Feature/OrderWithScoreTest.php)

Задание №8 исполняемым файлом [TaskShedule](https://github.com/AslanAV/dimaestri-test/blob/main/TaskShedule) и решено средствами Laravel:
- [код планировщика](https://github.com/AslanAV/dimaestri-test/blob/bf0b2e87e07a1ed5cbdc68648a57f26ed754166f/app/Console/Kernel.php#L19)
- планировщик - https://laravel.com/docs/9.x/scheduling#defining-schedules
- метод `update` Eloquent - https://laravel.com/docs/9.x/eloquent#mass-updates

## Setup project local

```shell
make setup
```

### Start server local
```shell
make start
```

***

## Setup project docker-compose
```shell
make compose-make-setup
```

### Start server docker-compose
```shell
make compose
```

### Stop server docker-compose
```shell
make compose-down
```
