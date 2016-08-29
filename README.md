
Unofficial MyTarget API Client
==============================

PHP клиент для работы с MyTarget API (v1/v2).

### Install it via composer
```
composer require dsl/my-target-api
```

### How to work with it?
```php
$clients = new ClientOperator(...);
$client = $clients->create(new AdditionalUserInfo("cl1"));

$campaigns = new CampaignOperator(...);

$targeting = new CampaignTargeting();
$targeting->setAge(range(20, 30));
$targeting->setSex(Sex::female());

$createCampaign = new CreateCampaign("awesome campaign", new PackageId(83), $targeting);
$createCampaign->setStatus(Status::active());

$createdCampaign = $campaigns->forClient($client->getUsername())->create($createCampaign);
```

Также можно не использовать `*Operator` классы, и вместо этого составлять запросы вручную. (об этом [ниже](#advanced-features-and-usage))

### Bootstrap it in 5 minutes
Для того чтобы пример выше заработал нужно создать граф зависимостей для `ClientOperator` и `CampaignOperator`.
Зависят оба этих оператора от компонентов `Client` и `Mapper`.
Для песочницы, инстанциировать клиент вместе с его зависимостями можно так:
```php
namespace sandbox;

use MyTarget\Client;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Client as GuzzleClient;
use MyTarget\Transport\GuzzleHttpTransport;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use MyTarget\Transport\Middleware\HttpMiddlewareStackPrototype;
use MyTarget\Transport\Middleware\Impl\CallbackMiddleware;
use MyTarget\Transport\Middleware\Impl\ResponseValidatingMiddleware;
use MyTarget\Token\Token;
use Psr\Http\Message\RequestInterface;

$baseUri = new Uri('https://target.my.com');
$token = new Token("ACCESS_TOKEN", "bearer", new \DateTime(), ""); // библиотека также в состоянии управлять набором токенов в любом типе хранилища (а также получать новые и рефрешить)

$http = new GuzzleHttpTransport(new GuzzleClient());
$httpStack = HttpMiddlewareStackPrototype::newEmpty($http);
$httpStack->push(new ResponseValidatingMiddleware());

// подпишем все запросы заранее полученным токеном (также можно использовать более сложный TokenGrantMiddleware, который способен хранить токен в любых хранилищах, обновлять и получать его)
$accessToken = "foo bar";
$httpStack->push(new CallbackMiddleware(function (RequestInterface $req, HttpMiddlewareStack $stack, $context = null) use ($accessToken) {
    $req = $req->withHeader('Authorization', sprintf('Bearer %s', $accessToken));
    return $stack->request($req, $context);
}));

$client = new Client(new RequestFactory($baseUri), $httpStack);
```
Это создаст простейший клиент который может самостоятельно подписывать все запросы переданным токеном и возвращать ответ в виде массива (либо выбрасывать исключение если что-то пошло не так).
Помимо этого есть дополнительные возможности, такие как управление токенами и учёт лимитов API. (об этом в [Advanced features](#advanced-features-and-usage))
Создать маппер для песочницы гораздо проще:
```php
$autoloader = require_once __DIR__ . '/../vendor/autoload.php'; // когда подключается автолоадер нужно присвоить его переменной (этот код будет в самом начале)
AnnotationRegistry::registerLoader([$autoloader, 'loadClass']); // нужно для правильной работы doctrine/annotations

$mapper = \MyTarget\simpleMapper($debug = true);
```
Теперь можно создать `ClientOperator` и получить список клиентов:
```php
$clients = new ClientOperator($client, $mapper);

var_dump($clients->all());
```

### Advanced features and usage

> TODO

### How does it work?
Весь проект разделен на несколько компонентов:
* Клиент (Transport) - всё что касается коммуникаций через сеть
* Маппер - нужен для того чтобы отображать ответы API на объекты
* Набор операторов - типизируют все возможные отправляемые и получаемые значения в виде объектов

Клиент использует набор [middleware](#httpmiddleware) объектов которые имеют доступ к чтению/изменению запросов и ответов API.
Это позволяет легко разбивать различную функциональность, которая как-то связана с обработкой запросов, в разные сущности.
Например есть `LimitingMiddleware`, `ClientGrantMiddleware` и `ResponseValidatingMiddleware`.
Все они схожи в том, что все работают на уровне HTTP-сообщений, но при этом семантически не имеют ничего общего.

Маппер выполняет простую функцию отражения API-ответов на типизированные объекты: `$mapper->hydrateNew('Foo', $jsonObject)` вернёт экземпляр `Foo`, где поля этого объекта будут заполнены в соответствии с аннотациями вида `Field(name="api_field_name", type="string")` на них.

Операторы связывают два упомянутых выше компонента и позволяют работать с API на более высоком уровне. Но если вам не нравится работать с объектами и вас устраивают произвольные массивы данных, то есть возможность работать напрямую с клиентом. Таким образом вы все равно можете получить настроенную OAuth2 аутентификацию, конвертацию ошибочных ответов API в исключения и контроль ограничений на запросы.


### HttpMiddleware

Работа с сетью происходит с помощью `HttpMiddlewareStack`. Этот стек содержит все обработчики HTTP ответов и запросов, которые "стекуются" друг на друга. Пример обработчика выглядит так:
```php
class MyMiddleware implements HttpMiddleware
{
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        return $stack->request($request, $context);
    }
```

Этот middleware просто вызывает следующий за ним middleware. Данный вызов всегда возвращает объект типа `Psr7\ResponseInterface` (либо выбрасывает исключение). Вот пример более полезного middleware, который может логировать весь HTTP-обмен:
```php
class LoggingMiddleware implements HttpMiddleware
{
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        try {
            $response = $stack->request($request, $context);
            log($request, $response);
            return $response;
        } catch (RequestException $e) {
            logError($request, $e);
            throw $e;
        }
    }
}
```

### Exceptions hierarchy

Все исключения этой библиотеки подчиняются такой иерархии:

```
- MyTarget\Exception\MyTargetException - Интерфейс (маркер) всех исключений этой библиотеки (если есть необходимость "не выпускать" никаких исключений от СДК, то нужно ловить этот тип исключения)
  - MyTarget\Transport\Exception\TransportException - thrown during request transferring phase
    - MyTarget\Transport\Exception\RequestException
      - MyTarget\Transport\Exception\ClientErrorException
      - MyTarget\Transport\Exception\ConnectException
      - MyTarget\Transport\Exception\ServerErrorException
      - MyTarget\Transport\Exception\TooManyRedirectsException
      - MyTarget\Token\Exception\TokenRequestException
        - MyTarget\Token\Exception\TokenLimitReachedException
        - MyTarget\Token\Exception\TokenDeletedException
      - MyTarget\Limiting\Exception\ThrottleException - thrown before the request if you've reached the rate limit, or after the response is parsed and it contains a 429 code
  - MyTarget\Exception\DecodingException - thrown during response decoding phase
```

Помимо этого они все разделены на два вида: `Dsl\MyTarget\Exception\ApiException` и `Dsl\MyTarget\Transport\Exception\NetworkException`.

### How to contribute

Для того чтобы предложить свои изменения, вы можете сделать форк этого репозитория и создать PR с произвольным сообщением описывающим изменения.
