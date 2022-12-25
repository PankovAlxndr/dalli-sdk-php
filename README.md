# SDK для службы доставки Dalli

[![Build Status](https://scrutinizer-ci.com/g/PankovAlxndr/dalli-sdk-php/badges/build.png?b=main)](https://scrutinizer-ci.com/g/PankovAlxndr/dalli-sdk-php/build-status/main)
[![Code Coverage](https://scrutinizer-ci.com/g/PankovAlxndr/dalli-sdk-php/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/PankovAlxndr/dalli-sdk-php/?branch=main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/PankovAlxndr/dalli-sdk-php/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PankovAlxndr/dalli-sdk-php/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/PankovAlxndr/dalli-sdk-php/?branch=main)
[![Latest Stable Version](http://poser.pugx.org/pankovalxndr/dalli-sdk-php/v)](https://packagist.org/packages/pankovalxndr/dalli-sdk-php)
[![License](http://poser.pugx.org/pankovalxndr/dalli-sdk-php/license)](https://packagist.org/packages/pankovalxndr/dalli-sdk-php)

Реализация API для [службы доставки Dalli](https://dalli-service.com/).
Данная SDK поможет быстрее внедрить в свой проект взаимодействие со службой доставки Dalli.

Полное официальное описание взаимодействия с API Dalli можно найти [по ссылке](https://api.dalli-service.com/v1/doc/)

Возможности SDK:
- Добавить заявку в корзину
- Редактировать заявку в корзине
- Добавить заявку через Почту России
- Показать содержимое корзины
- Очистить корзины
- Отправка в доставку
- Получить акт ПП
- Получить наклейки
- Получить наклейки из корзины
- Запрос типов доставки
- Запрос интервалов доставки
- Запрос статуса заказов
- Пункты выдачи
- Расчет стоимости доставки

Работа со всеми методами API возможна только при наличии доступов к сервису интеграции, которые выдаются только при
обращении по электронной почте <it@dalli-service.com>

***

### Требования

Нужен PHP 7.4 или выше.

Данный SDK использует спецификацию [PSR-18 (HTTP-client)](https://www.php-fig.org/psr/psr-18/).
Это значит в качестве HTTP-клиента можно использовать любой - клиент, поддерживающий данную спецификацию.
Если у вашего клиента нет поддержки этой спецификации, можно
посмотреть [имеющиеся адаптеры для большинства популярных HTTP-клиентов](http://docs.php-http.org/en/latest/clients.html)

***

### Установка

Установка осуществляется с помощью менеджера пакетов Composer

```bash
composer require pankovalxndr/dalli-sdk-php
```

***

### Примеры использования (добавить заявку в корзину)
```php
$client = new Client(new \GuzzleHttp\Client(), 'my_awsome_token', Endpoint::MSK);

$items = [];
$item = new Item();
$order = new Order();
$receiver = new Receiver();

$receiver->setAddress('ул. Константина Константинопольского, д.1 к1')
    ->setTown('г. Москва')
    ->setPerson('Константин Константинопольский')
    ->setPhone('+7 000 000 00 00')
    ->setDate(new DateTime('2022-12-25'))
    ->setTimeMin('9:00')
    ->setTimeMax('22:00');

$item->setQuantity(2)
    ->setName('Моя тестовая товарная позиция')
    ->setWeight(3.15)
    ->setRetPrice(50.0)
    ->setInshPrice(5.0)
    ->setOriginCountry('RU')
    ->setGtd('10702030')
    ->setSuppCompany('Компания поставщик')
    ->setSuppPhone('+7 000 000 00 00')
    ->setSuppInn('3664069397')
    ->setType(1);
$items[] = $item;

$order->setNumber('sdk-001')
    ->setReceiver($receiver)
    ->setService(1)
    ->setWeight(3.15)
    ->setQuantity(1)
    ->setPayType(PayType::CASH)
    ->setPrice(150.0) // стоимость товарных позиций + стоимость доставки
    ->setPriced(50.0)
    ->setInshPrice(500.0)
    ->setInstruction('Максимально аккуратно')
    ->setItems($items);


$request = new CreateBasketRequest();
$request->addOrder($order);

$response = $client->sendCreateBasketRequest($request);

foreach ($response as $order) {
    $error = $order->getErrors();
    $success = $order->getSuccess();
    if ($success)
        echo $success->getBarcode() . PHP_EOL; // Штрих-код заказа в системе Dalli
}
```

### Тесты

Запуск тестов:

``` bash
composer test
```

### Лицензия

Данный проект распространяется [под лицензией MIT](LICENSE).