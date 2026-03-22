<?php

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Phizz\Support\StaticApi;
use Phizz\Support\StaticClient;
use Phizz\Support\StaticData;

function makeCDragonHttp(array $responses, array &$history = []): StaticClient
{
    $stack = HandlerStack::create(new MockHandler($responses));
    $stack->push(Middleware::history($history));

    return new StaticClient(new Guzzle(['handler' => $stack]));
}

function makeApi(StaticClient $http, string $version = 'latest'): StaticApi
{
    return new class($version, $http) extends StaticApi
    {
        public function callFetch(
            string $path,
            ?string $returnType = null,
            ?string $collectionType = null,
            ?string $idField = null,
            ?int $id = null,
        ): mixed {
            return $this->fetch($path, $returnType, $collectionType, $idField, $id);
        }
    };
}

function minimalDataClass(): string
{
    return new class([], 'latest') extends StaticData {};
}

it('returns raw array when no type params are given', function () {
    $data = [['id' => 1, 'name' => 'Foo'], ['id' => 2, 'name' => 'Bar']];
    $http = makeCDragonHttp([new Response(200, [], json_encode($data))]);
    $api = makeApi($http);

    $result = $api->callFetch('/v1/items.json');

    expect($result)->toBe($data);
});

it('returns a typed Collection when collectionType is given', function () {
    $itemClass = new class([], 'v') extends StaticData {};
    $itemFqcn = $itemClass::class;

    $data = [['id' => 1], ['id' => 2]];
    $http = makeCDragonHttp([new Response(200, [], json_encode($data))]);
    $api = makeApi($http);

    $result = $api->callFetch('/v1/items.json', collectionType: $itemFqcn);

    expect($result)->toBeInstanceOf(Collection::class)
        ->and($result)->toHaveCount(2)
        ->and($result->first())->toBeInstanceOf($itemClass::class);
});

it('returns a typed object when returnType is given', function () {
    $dataClass = new class([], 'v') extends StaticData {};
    $fqcn = $dataClass::class;

    $data = ['id' => 103, 'name' => 'Ahri'];
    $http = makeCDragonHttp([new Response(200, [], json_encode($data))]);
    $api = makeApi($http);

    $result = $api->callFetch('/v1/champions/103.json', returnType: $fqcn);

    expect($result)->toBeInstanceOf($dataClass::class);
});

it('returns a single typed object when id and idField are given', function () {
    $itemClass = new class([], 'v') extends StaticData {};
    $itemFqcn = $itemClass::class;

    $data = [['id' => 1, 'name' => 'A'], ['id' => 2, 'name' => 'B']];
    $http = makeCDragonHttp([new Response(200, [], json_encode($data))]);
    $api = makeApi($http);

    $result = $api->callFetch('/v1/items.json', collectionType: $itemFqcn, idField: 'id', id: 2);

    expect($result)->toBeInstanceOf($itemClass::class)
        ->and($result->name)->toBe('B');
});

it('throws InvalidArgumentException when the id is not found', function () {
    $itemClass = new class([], 'v') extends StaticData {};

    $data = [['id' => 1]];
    $http = makeCDragonHttp([new Response(200, [], json_encode($data))]);
    $api = makeApi($http);

    $api->callFetch('/v1/items.json', collectionType: $itemClass::class, idField: 'id', id: 999);
})->throws(InvalidArgumentException::class, "Item '999' not found.");

it('does not issue a second HTTP request for the same path', function () {
    $history = [];
    $data = [['id' => 1]];
    $http = makeCDragonHttp(
        [new Response(200, [], json_encode($data)), new Response(200, [], json_encode($data))],
        $history
    );
    $api = makeApi($http);

    $api->callFetch('/v1/items.json');
    $api->callFetch('/v1/items.json');

    expect(count($history))->toBe(1);
});

it('issues separate HTTP requests for different paths', function () {
    $history = [];
    $data = [['id' => 1]];
    $http = makeCDragonHttp(
        [new Response(200, [], json_encode($data)), new Response(200, [], json_encode($data))],
        $history
    );
    $api = makeApi($http);

    $api->callFetch('/v1/items.json');
    $api->callFetch('/v1/perks.json');

    expect(count($history))->toBe(2);
});

it('includes the version in the request URL', function () {
    $history = [];
    $http = makeCDragonHttp([new Response(200, [], json_encode([]))], $history);
    $api = makeApi($http, '14.1');

    $api->callFetch('/v1/items.json');

    $url = (string) $history[0]['request']->getUri();
    expect($url)->toContain('/14.1/');
});

it('passes the version to typed collection objects', function () {
    $itemClass = new class([], '') extends StaticData
    {
        public function getVersion(): string
        {
            return $this->version;
        }
    };

    $data = [['id' => 1]];
    $http = makeCDragonHttp([new Response(200, [], json_encode($data))]);
    $api = makeApi($http, '14.1');

    $result = $api->callFetch('/v1/items.json', collectionType: $itemClass::class);

    expect($result->first()->getVersion())->toBe('14.1');
});

it('passes the version to a typed return object', function () {
    $dataClass = new class([], '') extends StaticData
    {
        public function getVersion(): string
        {
            return $this->version;
        }
    };

    $http = makeCDragonHttp([new Response(200, [], json_encode(['id' => 1]))]);
    $api = makeApi($http, '14.2');

    $result = $api->callFetch('/v1/champions/1.json', returnType: $dataClass::class);

    expect($result->getVersion())->toBe('14.2');
});

it('StaticClient ddragon builds the correct DDragon URL', function () {
    $history = [];
    $stack = GuzzleHttp\HandlerStack::create(new GuzzleHttp\Handler\MockHandler([
        new Response(200, [], json_encode(['15.1.1', '15.1.0'])),
    ]));
    $stack->push(GuzzleHttp\Middleware::history($history));
    $client = new StaticClient(new GuzzleHttp\Client(['handler' => $stack]));

    $result = $client->ddragon('/api/versions.json');

    $url = (string) $history[0]['request']->getUri();
    expect($url)->toStartWith('https://ddragon.leagueoflegends.com')
        ->and($result)->toBe(['15.1.1', '15.1.0']);
});

it('toUrl strips the asset prefix and builds the CDragon URL', function () {
    $http = makeCDragonHttp([]);
    $api = new class('14.5', $http) extends StaticApi
    {
        public function callToUrl(string $path): string
        {
            return $this->toUrl($path);
        }
    };

    $url = $api->callToUrl('/lol-game-data/assets/v1/champion-icons/103.png');

    expect($url)->toBe(
        'https://raw.communitydragon.org/14.5/plugins/rcp-be-lol-game-data/global/default/v1/champion-icons/103.png'
    );
});
