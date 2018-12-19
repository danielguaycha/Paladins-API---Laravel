# Paladins API - Laravel
Api de PaladinsGame basada en Laravel, usando el paquete:  [team-reflex](https://packagist.org/packages/team-reflex/paladins-api). Es un proyecto que inicie con el fin de crear una pagina SPA en Español para uno de mis juegos Favoritos. Si te gustaría colaborar! escríbeme a mis redes sociales o correo. Encantado de seguir trabajando en esto.
* [Facebook](https://www.facebook.com/daniguaycha)
* [Twitter](https://twitter.com/detzerg)
* Correo: danielguaycha@gmail.com

## Importante
* Antes de usar este repo se recomienda leer el siguiente [Documento](https://docs.google.com/document/d/1OFS-3ocSx-1Rvg4afAnEHlT3917MAK_6eJTR6rzr-BM/edit#), sobre las especificaciones que da HI-REX sobre la API de Paladins.
* Para usar la api es necesario registrarse como desarrollador y obtener un `API KEY` y `AUTH KEY`, para hacerlo dirígete a este [enlace](https://fs12.formsite.com/HiRez/form48/secure_index.html).

## Configuración
1. Clonar el Repositorio
2. Instalar los paquetes con `composer` 
3. Obtener un `API KEY` y `AUTH KEY` de [Aqui](https://fs12.formsite.com/HiRez/form48/secure_index.html)
4. Configurar la `API KEY` y `AUTH KEY` en `app/Http/Controllers/InitController`
   ```php
    private $devId = your_dev_id;
    private $authKey = "your_auth_key";
   ```
5. Iniciar el servidor

## Instrucciones
Todas las urls se encuentran en el archivo `routes/api.php` cada una enlazada al controlador `app/Http/Controllers/InitController` y son las siguientes.

```php
// Datos generales de uso de datos, dev y Api
Route::get('/data/{type}', 'InitController@getData');

// Player data: Datos como Amigo, perfil, estaditicas, estado, barajas, campeones
Route::get('/champ-ranks/{nick}', 'InitController@getChampRanks');
Route::get('/player/friends/{nick}', 'InitController@getfriends');
Route::get('/player/stats/{nick}/{queue}', 'InitController@getPlayerStats');
Route::get('/player/{nick}/', 'InitController@getPlayer');
Route::get('/player/data/{player_id}/', 'InitController@getPlayerData'); // Ejem. id = 10561387
Route::get('/player/status/{player}/', 'InitController@getPlayerStatus');
Route::get('/player/loadouts/{player_id}/', 'InitController@getPlayerLoadOuts');

//Champions Data: Datos como lista de campeones, habilidades, cartas, etc
Route::get('/champions', 'InitController@getChamps');
Route::get('/champions/cards/{champ_id}', 'InitController@getChampionsCards');
Route::get('/champions/{champ_id}/{queue}/list', 'InitController@getChampionLeaderboard');
Route::get('/champs', 'InitController@getChampions');

// Items Data: Items como Cauterizar, Derruidor, Cartas de los campeones, Legandarias, etc
Route::get('/items', 'InitController@getItems');

// Matches Data: Datos de las partidas que juega una persona y más.
Route::get('/matches/{nick}', 'InitController@getMatches');
Route::get('/matches/detail/{id}', 'InitController@getMatchById');
Route::get('/matches/players/{match_id}', 'InitController@getMatchPlayerDetails');
Route::get('/matches/join/{matches}', 'InitController@getMatchBatch'); // match_id,match_id,match_id ....

// Season Data: Datos de la actual Season
Route::get('/season-data', 'InitController@getSessionData');
Route::get('/season/{queue}', 'InitController@getLeagueSeasons');
Route::get('/motd', 'InitController@getMotd');

//LeaderBoard: Algunos Tops
Route::get('/leaderboard/{queue}/{rank}/{season}', 'InitController@getLeaderBoard');
```
Un ejemplo de url sería `http://127.0.0.1:8000/api/champions` insertando `api/` antes de cada url.

Las Respuestas son en formato JSON

## Controlador
El controlador `InitController` tiene una serie de funciones para llamar los datos.

### Constructor
Aquí se pasan los datos de configuración como `API KEY` y `AUTH KEY`, además de una `URL` que en este ejemplo es para obtener datos de jugadores PC, sin embargo puede revisar este [Documento](https://docs.google.com/document/d/1OFS-3ocSx-1Rvg4afAnEHlT3917MAK_6eJTR6rzr-BM/edit#), para obtener las URLS de otras consolas.
```php
function __construct()
{
    $cache = new IlluminateCache(app(Repository::class));
    $this->api = new API($this->devId, $this->authKey, 'http://api.paladins.com/paladinsapi.svc/');
    $this->api->preferredLanguage('es-419');
}
```

### Funciones
```php
public function getChamps(){
    $playerData= $this->api->request('getgods');
    return response()->json($playerData);
}
```
### Parámetros
En ocasiones estas funciones reciben parámetros como: 
```php
$queue_temp     # El Identificador de la cola, buscar el Array: $queue en InitController
$champ_id       # Id de un campeon que puedes obtener de /champions
$rank           # Es el rango, buscar el Array: $tierMap en InitController
```

## Algo más
Entre los archivos encontrarás uno llamado `paladins.sql` que es un `backup` de la base de datos con la cual estaba trabajando, además también podrás ver en la carpeta `database/migrations` algunas migraciones de esta base de datos.

El Controlador `InitController` también posee alguno métodos extra que se usaron para ingresar las peticiones directamente a la base de datos.

Sin más espero te sirva.