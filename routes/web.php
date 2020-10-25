<?php

use App\Models\Redirect;
use Illuminate\Http\Request;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/api/redirects/create', 'ApiController@create');
$router->get('/api/redirects/create_many', 'ApiController@createMany');

$router->get('/', 'HomeController@index');
$router->get('/{tiny:.+}', 'HomeController@redirect');
